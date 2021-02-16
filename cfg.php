<?php
$dbhostname = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db_name = 'moja_strona';
	
$link =  new mysqli($dbhostname, $dbuser, $dbpass, $db_name);

if(!$link) echo '<b>Przerwane połączenie</b>';  

?> 