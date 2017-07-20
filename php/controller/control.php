<?php
	require_once "controlClass.php";
	$controller = new controlClass($_POST);
	$controller->actionToDO();
?>
