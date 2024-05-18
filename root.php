<?php
	$ALLOWED_INCLUDES = array(
		"/calc" => "/calc.php",
		"/calc/" => "/calc.php",
		"/register" => "/register.php",
		"/register/" => "/register.php",
		"/login" => "/login.php",
		"/login/" => "/login.php",
		"/disconnect" => "/disconnect.php",
		"/disconnect/" => "/disconnect.php",
		"/mirror" => "/mirror.php",
		"/mirror/" => "/mirror.php",
		"/" => "/calc.php",
		"/api/calcul/" => "/api.php",
		"/api/user/" => "/api.php",
		"/api/user/create/" => "/api.php",
		"/api/user/update/" => "/api.php",
		"/particles.min.js" => "/particles.min.js",
		"/particles.json" => "/particles.json"
	);
	
	$BASE_PATH = getcwd()."/__html";
	$REQ = $_SERVER["REQUEST_URI"];
	$ALLOWED = false;

	foreach($ALLOWED_INCLUDES as $key => $value) if($key == $REQ) $ALLOWED = true;

	session_start();

	if(! isset($_SESSION["CONNECTED"])) $_SESSION["CONNECTED"] = 0;
	if(! isset($_SESSION["USERNAME"])) $_SESSION["USERNAME"] = "anonymous";
	if(! isset($_COOKIE["JSESSID"])) setcookie("JSESSID", md5("anonymous"));

	if($ALLOWED) include($BASE_PATH.$ALLOWED_INCLUDES[$REQ]);
	else include($BASE_PATH."/all.php");
?>
