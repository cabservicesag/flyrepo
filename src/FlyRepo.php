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

class FlyRepo {

	const FLYREPO_DIR = '.flyrepo';
	const CONF_FILE = 'config.json';

	public $dir;

	/**
	 * use FlyRepo::open('./')->doSomething() pattern
	 */
	private function __construct($dir) {
		$this->dir = $dir;
	}

	/**
	 * open the flyrepo of this mainfolder
	 * 
	 * @param string $dir path to the directory containing .flyrepo
	 */
	public static function open($dir) {
		if (!is_dir($dir . '/' . self::FLYREPO_DIR)) {
			throw new \Exception('could not find flyrepo directory ' . $dir . self::FLYREPO_DIR);
		}

		$flyRepo = new FlyRepo($dir);

		return $dir;
	}

	/**
	 * init a new flyrepo of this mainfolder
	 * 
	 * @param string $dir path to the directory containing .flyrepo
	 */
	public static function init($dir, $conf) {
		$flyRepoPath = $dir . '/' . self::FLYREPO_DIR;
		
		if (is_dir($flyRepoPath)) {
			throw new \Exception('flyrepo already exists, please remove first to init from scratch ' . $flyRepoPath);
		}

		mkdir($dir . '/' . self::FLYREPO_DIR);
		$confData = json_encode($conf, JSON_PRETTY_PRINT);
		file_put_contents($flyRepoPath . '/' . self::CONF_FILE, $confData);

		$flyRepo = self::open($dir);

		return $flyRepo;
	}

}
