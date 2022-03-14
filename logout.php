<?php

session_start();

if (isset($_SESSION['mysocial_userid']))
{
	// code...
	$_SESSION['mysocial_userid'] = NULL;
	unset($_SESSION['mysocial_userid']);
}

header("Location: login.php");
die();