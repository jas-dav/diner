<?php

// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start a session
session_start();

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

// Define a order form route (328/diner/order1)
$f3->route('GET||POST /order1', function ($f3){

    // if the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // move data from POST array to SESSION array
        $_SESSION['food'] = $_POST['food'];
        $_SESSION['meal'] = $_POST['meal'];

        //redirect to summary page
        $f3->reroute('summary');

    }
    // Instantiate view
    $view = new Template();
    echo $view->render('views/order-form1.html');
});

// Define a order summary route (328/diner/summary)
$f3->route('GET /summary', function (){
    // Instantiate view
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-Free
$f3->run();

?>