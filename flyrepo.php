#!/usr/bin/env php
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

/*
 * use composer autoloader if possible
 * it has to work without composer
 */
if(include('vendor/autoload.php')) {
	define('FLYREPO_COMPOSER', true);
} else {
	define('FLYREPO_COMPOSER', false);
	require_once('nocomposerAutoloader.php');
}

try {
	$clInterface = \cabservicesag\FlyRepo\ClInterface::start($argv)->run();
} catch (Exception $flyRepoException ) {
	print($flyRepoException->getMessage()."\n");
	exit(1);
}