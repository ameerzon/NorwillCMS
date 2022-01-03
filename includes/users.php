<?php

$users = [];

$fu = fopen("./config/users.cfg", "r");

while ( !feof($fu) )
{
	$next = explode(";", chop(fgets($fu)) );
	
	$users[$next[0]] = $next;
}

fclose($fu);


?>