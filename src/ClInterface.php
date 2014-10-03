<?php

/* 
 * Copyright (C) 2014 Jonas Felix <jf@cabag.ch>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace cabservicesag\FlyRepo;

class ClInterface {
	const COMMAND_NAMESPACE = 'cabservicesag\\FlyRepo\\Command\\';
	
	public $flyRepo = false;
	
	public $argv = array();
	
	private $command = false;
	private $commandName = false;
	
	const USAGE_INFO = "FlyRepo: *Cause live is to short to build packages*\n\nUsage: flyrepo.php <command> \n\n";
	public $availableCommands = array('init');
	public $availableOptions = array(
		'C:' => 'Change working directory.'
		);
	public $dir = false;
	public $options = array();
	
	
	/**
	 * ClInterface::run($argv)
	 * I just like this pattern
	 */
	private function __construct() {
	}
	
	/**
	 * start the interface
	 * 
	 * @param array $argv
	 * @return \cabservicesag\FlyRepo\ClInterface
	 */
	public static function start($argv) {
		$clInterface = new ClInterface();
		$clInterface->argv = $argv;
		return $clInterface;
	}
	
	/**
	 * run the command
	 * 
	 * @return \cabservicesag\FlyRepo\ClInterface 
	 */
	public function run() {
		if(empty($this->argv[1])) {
			$this->showUsage();
			throw new \Exception('no command given');
		}
		
		// try to find the command and execute it
		$this->commandName = preg_replace('/[\s\W]+/', '', $this->argv[1]);
		$commandClass = self::COMMAND_NAMESPACE . ucfirst($this->commandName);
		if(!class_exists($commandClass, true)) {
			throw new \Exception ('command "' . $this->commandName . '" not found.');
		}
	
		$this->options = self::parseOptions($this->availableOptions, $this->argv);
		$this->setDir();
		
		if($commandClass::AUTO_OPEN) {
			$this->flyRepo = FlyRepo::open($this->dir);
		}
		$this->command = new $commandClass($this, $this->argv);
		$this->command->run();
		return $this;
	}
	
	public static function parseOptions($availableOptions, $argv) {
		$options = array();
		foreach($availableOptions as $option => $description) {
			$hasvalue = (substr($option, 1, 1) == ':');
			$mandatory = (substr($option, 1, 2) == '::');
			$option = substr($option, 0, 1);
			$argvKey = array_search('-' . $option, $argv);
			if($argvKey) {
				if($hasvalue) {
					$options[$option] = $argv[($argvKey + 1)];
				} else {
					$options[$option] = 1;
				}
			}
			if($mandatory && empty($options[$option])) {
				throw new \Exception('missing argument -' . $option . ' : ' . $description);
			}
		}
		return $options;
	}
	
	public function setDir() {
		if($this->options['C']) {
			$this->dir = $this->options['C'];
		} else {
			$this->dir = getcwd();
		}
	}

	/**
	 * show usage
	 */
	public function showUsage() {
		$optionsExplained = "General Options: \n";
		foreach($this->availableOptions as $option => $description) {
			$optionsExplained .= "-$option \t " . $description;
		}
		$commandUsages = "\n\nCommands: \n";
		foreach($this->availableCommands as $commandName) {
			$commandClass = self::COMMAND_NAMESPACE . $commandName;
			$commandUsages .= $commandClass::USAGE_INFO . "\n";
		}
		$this->show(self::USAGE_INFO . $optionsExplained . $commandUsages . "\n");
	}
	
	/**
	 * show a line of data
	 * 
	 * @param string $print
	 */
	public function show($output) {
		print($output."\n");
	}
}