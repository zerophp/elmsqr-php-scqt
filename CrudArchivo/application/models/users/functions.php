<?php

/**
 * Read Users from file, and return into array
 * 
 * @param string $filename
 * @return array $arrayUsers
 */
function readUsers($filename)
{
	$content=file_get_contents($filename);
	$files=explode("\r", $content);	
	foreach($files as $key => $file){
		$arrayUsers[]=explode("|",$file);
	}	
	return $arrayUsers;
}