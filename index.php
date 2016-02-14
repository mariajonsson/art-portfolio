<?php 
/**
 * This is an Opal pagecontroller.
 *
 */
// Include the essential config-file which also creates the $opal variable with its defaults.
include(__DIR__.'/config.php'); 
 
$content = new CContent($opal['database']);
$html = $content->ShowPage("index"); 
// Do it and store it all in variables in the Opal container.
$opal['title'] = "Maria Jonsson";
$opal['bodyid'] = 'index';

 
$opal['main'] = <<<EOD
$html
EOD;
 
 
 
// Finally, leave it all to the rendering phase of Opal.
include(OPAL_THEME_PATH);