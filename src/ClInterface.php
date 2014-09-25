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
	public $flyRepo = false;
	private $argv = array();
	private $commandName = false;
	private $command = false;
	
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
		
		// remove flyrepo.php from arguments if called php flyrepo.php
		if($argv[1] == __FILE__) {
			$argv = array_shift($argv);
		}
		
		$clInterface->setArgv($argv);
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
		
		$this->commandName = preg_replace('/[\s\W]+/', '', $this->argv[1]);
		$commandClass = '\\cabservicesag\\FlyRepo\\Command\\' . ucfirst($this->commandName);
		$this->show($commandClass);
		if(!class_exists($commandClass, true)) {
			throw new \Exception ('command "' . $this->commandName . '" not found.');
		}
		$this->command = new $commandClass($this, $this->argv);
		return $this;
	}
	
	/**
	 * show usage
	 */
	public function showUsage() {
		$this->show('Usage: flyrepo.php <command>');
	}
	
	/**
	 * show a line of data
	 * 
	 * @param string $print
	 */
	public function show($output) {
		print($output."\n");
	}
	
	
	/**
	 * open the fly repository
	 * 
	 * @param string $basePath
	 */
	public function openFlyRepo($basePath) {
		$this->flyRepo = FlyRepo::open($basePath);
	}
	
	/**
	 * set argv 
	 * 
	 * @param array $argv
	 * @return \cabservicesag\FlyRepo\ClInterface
	 */
	public function setArgv($argv) {
		$this->argv = $argv;
		return $this;
	}
}