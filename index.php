<?php

// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');

// Instantiate F3 base class
$f3 = Base::instance();


// Define a default route (328/diner)
$f3->route('GET /', function (){ // invokes an anonymous function
    // Instantiate view
    $view = new Template();
    echo $view->render('views/diner-home.html');
//    echo "Welcome";
});

// Define a breakfast route (328/diner/breakfast)
$f3->route('GET /breakfast', function (){
    // Instantiate view
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

// Define a lunch route (328/diner/lunch)
$f3->route('GET /lunch', function (){
    // Instantiate view
    $view = new Template();
    echo $view->render('views/lunch.html');
});

// Run Fat-Free
$f3->run();

?>