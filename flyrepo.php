<?php

echo "FlyRepo: Live is to short to build packages!\n\n";

// temporary, will be replaced by autoloader
require_once('src/FlyRepo.php');

try {
	$flyRepo = \cabservicesag\FlyRepo\FlyRepo::open('./');
} catch (Exception $flyRepoException ) {
	print($flyRepoException->getMessage()."\n");	
}