<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	session_start();
	
	include('cfg.php');
	include('admin.php');
	
	echo FormularzLogowania();
	echo Login();

?>