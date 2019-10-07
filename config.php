<?php
/**
 * Config-file for Opal. Change settings here to affect installation.
 *
 */
 
/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly
 
 
/**
 * Define Opal paths.
 *
 */
define('OPAL_INSTALL_PATH', __DIR__ . '/opal');
define('OPAL_THEME_PATH', OPAL_INSTALL_PATH . '/theme/render.php');
 
 
/**
 * Include bootstrapping functions.
 *
 */
include(OPAL_INSTALL_PATH . '/src/bootstrap.php');
 
 
/**
 * Start the session.
 *
 */
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();
 
 
/**
 * Create the Opal variable.
 *
 */
$opal = array();

/**
 * Settings for the database.
 *
 */
$opal['database']['dsn']            = 'mysql:host=localhost;dbname=artportfolio;';
$opal['database']['username']       = 'root';
$opal['database']['password']       = 'M34Xylon';
$opal['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
 
/**
 * Site wide settings.
 *
 */
$opal['lang']         = 'sv';
$opal['title_append'] = ' | mariajonsson.com';

$opal['header'] = <<<EOD
<a href="index.php"><span class='sitetitle'>Maria Jonsson</span></a>
EOD;
$opal['footer'] = <<<EOD
<footer><!--span class='sitefooter'><!--Copyright (c) Maria Jonsson><!--/span></footer>
EOD;

/**
 * Admin navbar
 *
 */
//$opal['adminbar'] = null; // To skip the navbar

if (isset($_SESSION['user'])) {
  if($_SESSION['user']->userrole=="admin") {
/**
 * Define the menu as an array
 */
$opal['adminbar'] = array(
  // Use for styling the menu
  'class' => 'adminbar',
 
  // Here comes the menu strcture
  'items' => array(
  
  // This is a menu item
     'admin'  => array(
      'text'  => 'Admin',   
      'url'   => 'admin.php',  
       'title' => 'Admin page'
        ),
  
  ),
  

  // This is the callback tracing the current selected menu item base on scriptname
  'callback' => function($url) {
  
  //Modified
  if(basename($_SERVER['REQUEST_URI']) == $url) {
      return true;
    }

  }
);

  }
   
 }
 else {
  $opal['adminbar']=null;
 }


/**
 * The navbar
 *
 */
//$opal['navbar'] = null; // To skip the navbar


/**
 * Define the menu as an array
 */
$opal['navbar'] = array(
  // Use for styling the menu
  'class' => 'navbar',
 
  // Here comes the menu strcture
  'items' => array(
  
    // This is a menu item
   /* 'home'  => array(
      'text'  =>'Start',   
      'url'   =>'index.php',  
      'title' => 'Start'
    ),*/
    
        // This is a menu item
    'works'  => array(
      'text'  =>'verk',   
      'url'   =>'works.php',  
      'title' => 'Verk'
    ),
    
    // This is a menu item
    'cv'  => array(
      'text'  =>'cv',   
      'url'   =>'cv.php',  
      'title' => 'CV'
    ),
    
        // This is a menu item
    'contact'  => array(
      'text'  =>'kontakt',   
      'url'   =>'contact.php',  
      'title' => 'Kontakt'
    ),
        // This is a menu item
    'blog'  => array(
      'text'  =>'blogg',   
      'url'   =>'blogg',  
      'title' => 'Blogg'
    ),


       // This is a menu item
     /*'gallery'  => array(
      'text'  => 'Gallery',   
      'url'   => 'gallery.php',  
       'title' => 'Gallery demo'
        ),
      */
     
     
  ),
  

 
  // This is the callback tracing the current selected menu item base on scriptname
  'callback' => function($url) {

  
  //Modified (match exact)
  /*if(basename($_SERVER['REQUEST_URI']) == $url) {
      return true;
    }
    */
  
  // Original version (match filename)
  if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
      return true;
    } 
     //This is to match only the first part of the name
    /* if (contains_substr($url, basename($_SERVER['SCRIPT_FILENAME']), 0)) {
      return true; 
    } */
  }
);


/**
 * Theme related settings.
 *
 */
$opal['stylesheets'] = array('css/style.css','css/source.css','css/figure.css','css/breadcrumb.css','css/gallery.css');
$opal['favicon']    = 'favicon.ico';

/**
 * Settings for JavaScript.
 *
 */
$opal['modernizr'] = 'js/modernizr.js';

$opal['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js';
//$opal['jquery'] = null; // To disable jQuery

$opal['javascript_include'] = array();
//$opal['javascript_include'] = array('js/main.js'); // To add extra javascript files

/**
 * Google analytics.
 *
 */
$opal['google_analytics'] = 'UA-22093351-1'; // Set to null to disable google analytics