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

namespace cabservicesag\FlyRepo\Command;

class Init extends AbstractCommand {
	const AUTO_OPEN = false;
	public $availableOptions = array(
		'i::' => 'url of your index repository',
		'p::' => 'url of your project repository'
		);
	
	public function run() {
		$conf = array (
			'myIndexRepository' => $this->options[i],
			'myProjectRepository' => $this->options[i],
		);
		
		$this->clInterface->flyRepo = \cabservicesag\FlyRepo\FlyRepo::init(
				$this->clInterface->dir, $conf);
	}
}