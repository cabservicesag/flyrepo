<?php

if(empty($argv[1])) {
	echo "usage:> php createRepoFilesFromGithubJson.php file.json install/path/relative/to/webroot \n";
	exit;
}

$repos = json_decode(file_get_contents($argv[1]), true);

$repoIdxBaseDir = 'repositories';
if(!is_dir($repoIdxBaseDir)) {
	mkdir($repoIdxBaseDir);
}

foreach($repos as $repo) {
	$ownerDir = $repoIdxBaseDir.'/'.$repo['owner']['login'];
	if(!is_dir($ownerDir)) {
		mkdir($ownerDir);
	}
	$repoDir = $ownerDir.'/'.$repo['name'];
	if(!is_dir($repoDir)) {
		mkdir($repoDir);
	}
	$repoInfo = array(
		'description' => $repo['description'],
		'installpath' => $argv[2].'/'.$repo['name'],
		'repository' => $repo['clone_url']
		);
	$repoInfoJson = json_encode($repoInfo, JSON_PRETTY_PRINT);
	file_put_contents($repoDir.'/repository.json', $repoInfoJson);
}