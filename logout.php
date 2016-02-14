<?php 
/**
 * This is an Opal pagecontroller.
 *
 */
include(__DIR__.'/config.php');

$user = new CUser($opal['database']);

// Logout the user
if(isset($_POST['logout'])) {
  $user->Logout();
}

$html = $user->ShowLogin("logout");

// Do it and store it all in variables in the Opal container.
$opal['title'] = "Logout";
 

 
$opal['main'] = <<<EOD
<h1>Logout</h1>
$html
EOD;

 

 
 
// Finally, leave it all to the rendering phase of Opal.
include(OPAL_THEME_PATH);