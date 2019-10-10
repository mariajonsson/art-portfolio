<?php 
/**
 * This is an Opal pagecontroller.
 *
 */
// Include the essential config-file which also creates the $opal variable with its defaults.
include(__DIR__.'/config.php'); 

$works = new CArtwork($opal['database']);
$menu = $works->ThemeMenu();
$html = $works->ShowFilteredWorks();
 
// Do it and store it all in variables in the Opal container.
$opal['title'] = "Teman";
$opal['bodyid'] = 'theme';

 
$opal['main'] = <<<EOD
$menu
$html
EOD;
 
 
 
// Finally, leave it all to the rendering phase of Opal.
include(OPAL_THEME_PATH);