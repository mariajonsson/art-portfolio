<?php 
/**
 * This is an Opal pagecontroller.
 *
 */
// Include the essential config-file which also creates the $opal variable with its defaults.
include(__DIR__.'/config.php'); 

$cv = new CCV($opal['database']);
$html = $cv->CVPresentAll();
 
// Do it and store it all in variables in the Opal container.
$opal['title'] = "CV";
$opal['bodyid'] = 'cv';

 
$opal['main'] = <<<EOD
<h1>CV</h1>
$html
EOD;
 
 
 
// Finally, leave it all to the rendering phase of Opal.
include(OPAL_THEME_PATH);