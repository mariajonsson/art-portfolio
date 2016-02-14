<?php 
/**
 * This is an Opal pagecontroller.
 *
 */
include(__DIR__.'/config.php');

$user = new CUser($opal['database']);

if(isset($_POST['login'])) {
	$user->Login(isset($_POST['name']) ? $_POST['name'] : null, isset($_POST['acronym']) ? $_POST['acronym'] : null);
}
if(isset($_POST['logout'])) {
  $user->Logout();
}

$html = $user->ShowLogin("login");

// Do it and store it all in variables in the Opal container.
$opal['title'] = "Login";
$opal['bodyid'] = "login";
 

$opal['main'] = <<<EOD
<h1>Login</h1>
$html
EOD;

 
 
// Finally, leave it all to the rendering phase of Opal.
include(OPAL_THEME_PATH);