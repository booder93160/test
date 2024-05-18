<?php
	session_unset();
	session_destroy();
	setcookie('JSESSID', '', -1, '/');
	header("Location: /");
?>
