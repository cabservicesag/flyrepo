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
	
	/**
	 * use FlyRepo::open('./')->doSomething() pattern
	 */
	private function __construct() {
	}
	
	/**
	 * open the flyrepo of this mainfolder
	 * 
	 * @param string $basePath path to the directory containing .flyrepo
	 */
	public static function open($basePath) {
		if(!is_dir($basePath.self::FLYREPO_DIR)) {
			throw new \Exception('could not find flyrepo directory '.$basePath.self::FLYREPO_DIR);
		}
	}
}