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
	private $argv = array();
	
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
	public static function run($argv) {
		$clInterface = new ClInterface();
		$clInterface->setArgv($argv);
		$clInterface->openFlyRepo('./');
		return $clInterface;
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