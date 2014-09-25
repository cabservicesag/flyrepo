<?php

if(empty($argv[1]) || empty($argv[2])) {
	echo "usage:> php getRepoFromGithubUser.php username githubtoken \n";
	exit;
}

$githubUrl = 'https://api.github.com/users/'.$argv[1].'/repos?per_page=100';

$page = 0;
$authKey = preg_replace('/[\s\W]+/', '', $argv[2]);
$repos = array();
while($page < 100) {
	$command = 'curl -u '.$authKey.':x-oauth-basic '.escapeshellarg($githubUrl.'&page='.$page);
	echo $command."\n";
	$reposJson = shell_exec($command);
	$currentRepos = json_decode($reposJson, true);
	if(empty($currentRepos[0]['clone_url'])) {
		break;	
	}
	$repos = array_merge($repos, $currentRepos);
	sleep(0.5);
	$page++;
}

file_put_contents('repolist-'.$argv[1].'.json', json_encode($repos,  JSON_PRETTY_PRINT));
