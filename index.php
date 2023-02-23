<?php

//// order1 route -> views/order-form1.html
//// summary route -> views/order-order-summary.html
//
////This is my controller
//
////Turn on error reporting
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//
////Start a session
//session_start();
//
////Require autoload, data-layer, validate files
//require_once('vendor/autoload.php');
//require_once('model/data-layer.php');
//require_once('model/validate.php');
//
///*
//// TEST validate validFood function
//$food1 = "tacos";
//$food2 = "";
//$food3 = "x";
//echo validFood($food1) ? "valid" : "not valid"; // shortcut for if block
//echo validFood($food2) ? "valid" : "not valid"; // shortcut for if block
//echo validFood($food3) ? "valid" : "not valid"; // shortcut for if block
//*/
//
////var_dump(getMeals()); // prints out getMeals function array
//
//
////Instantiate F3 Base class
//$f3 = Base::instance();
//
////Define a default route (328/diner)
//$f3->route('GET /', function() {
//
//    //Instantiate a view
//    $view = new Template();
//    echo $view->render("views/diner-home.html");
//
//});
//
////Define a breakfast route (328/diner/breakfast)
//$f3->route('GET /breakfast', function() {
//
//    //Instantiate a view
//    $view = new Template();
//    echo $view->render("views/breakfast.html");
//
//});
//
////Define an order1 route (328/diner/order1)
//$f3->route('GET|POST /order1', function($f3) {
//
//    //var_dump($_POST);
//    //["food"]=> string(5) "pizza" ["meal"]=> string(9) "breakfast" }
//
//
//    //If the form has been submitted
//    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//        //Move data from POST array to SESSION array - if form has been posted
//        $food = trim($_POST['food']); // trim food
//        if(validFood($food)){ // if valid put in session array
//            $_SESSION['food'] = $food;
//        }
//        else { // if not valid, create variable to store error msg
//            $f3->set('error["food"]',
//                'Food must have at least 2 chars');
//        }
//        // Validate the meal
//        $meal = $_POST['meal'];
//        if(validMeal($meal)) {
//            $_SESSION['meal'] = $meal;
//        }
//        else {
//            $f3->set('error["meal"]',
//                'Meal is invalid');
//        }
//
//        //Redirect to summary page
//        // if there are no errors - go to next page
//        if(empty($f3->get('errors'))) {
//            $f3->reroute('order2');
//        }
//    }
//
//    // Add meals to F3 hive
//    $f3->set("meals", getMeals()); // set meals to whatever the getMeals function returns
//
//    //Instantiate a view - if form hasn't been posted
//    $view = new Template();
//    echo $view->render("views/order-form1.html");
//
//});
//
////Define an order2 route (328/diner/order2)
//$f3->route('GET|POST /order2', function($f3) {
//
//    //If the form has been submitted
//    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//        //Move data from POST array to SESSION array
//        $_SESSION['conds'] = implode(", ",$_POST['conds']);
//
//        //Redirect to summary page
//        $f3->reroute('summary');
//    }
//
//    // Add meals to F3 hive
//    $f3->set("condiments", getCondiments());
//
//    //Instantiate a view
//    $view = new Template();
//    echo $view->render("views/order-form2.html");
//
//});
//
////Define a summary route (328/diner/summary)
//$f3->route('GET /summary', function() {
//
//    //Instantiate a view
//    $view = new Template();
//    echo $view->render("views/order-summary.html");
//
//});
//
//
////Run Fat Free
//$f3->run();


// order1 route -> views/order-form1.html
// summary route -> views/order-order-summary.html

//This is my controller

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require files
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validate.php');
//require_once('classes/order.php');

//Start a session AFTER requiring autoload.php
session_start();
//var_dump($_SESSION);

//$myOrder = new Order();
//// test setFood method
//$myOrder->setFood("tacos");
//echo $myOrder->getFood();
//// test setMeal method
//$myOrder->setMeal("lunch");
//echo $myOrder->getMeal();
// test setCondiments method
//$myOrder->setCondiments("ketchup");
//echo $myOrder->getCondiments();

//var_dump($myOrder);


/*
$food1 = "tacos";
$food2 = "        ";
$food3 = "x";
echo validFood($food1) ? "valid" : "not valid";
echo validFood($food2) ? "valid" : "not valid";
echo validFood($food3) ? "valid" : "not valid";
*/
//var_dump(getMeals());
//var_dump(getCondiments());

//Instantiate F3 Base class
$f3 = Base::instance();

//Define a default route (328/diner)
$f3->route('GET /', function () {

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/diner-home.html");

});

//Define a breakfast route (328/diner/breakfast)
$f3->route('GET /breakfast', function () {

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/breakfast.html");

});

//Define an order1 route (328/diner/order1)
$f3->route('GET|POST /order1', function ($f3) {

    //var_dump($_POST);
    //["food"]=> string(5) "pizza" ["meal"]=> string(9) "breakfast" }


    //If the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // create the object
        $newOrder = new Order();

        //Move food from POST array to SESSION array
        $food = trim($_POST['food']);
        if (validFood($food)) {
            //$_SESSION['food'] = $food;
            $newOrder->setFood($food);
        } else {
            $f3->set('errors["food"]',
                'Food must have at least 2 chars');
        }

        //Validate the meal
        $meal = $_POST['meal'];
        if (validMeal($meal)) {
            //$_SESSION['meal'] = $meal;
            $newOrder->setMeal($meal);
        } else {
            $f3->set('errors["meal"]',
                'Meal is invalid');
        }

        //Redirect to summary page
        //if there are no errors
        if (empty($f3->get('errors'))) {
            $_SESSION['newOrder'] = $newOrder;
            $f3->reroute('order2');
        }


    }

    //Add meals to F3 hive
    $f3->set('meals', getMeals());

    //Instantiate a view
    $view = new Template();
    echo $view->render('views/order-form1.html');

});

//Define an order2 route (328/diner/order2)
$f3->route('GET|POST /order2', function ($f3) {

    //If the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Move data from POST array to SESSION array
        //$_SESSION['conds'] = implode(", ", $_POST['conds']);

        $newOrder = $_SESSION['newOrder'];
        $condString = implode(", ", $_POST['conds']);
        $newOrder->setCondiments($condString);
        $_SESSION['newOrder'] = $newOrder;

        // the 4 lines of code above condensed into 2 lines:
        //$condString = implode(", ", $_POST['conds']);
        //$_SESSION['newOrder']->setCondiments($condString);


        //Redirect to summary page
        $f3->reroute('summary');
    }

    //Add condiments to the hive
    $f3->set('condiments', getCondiments());

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/order-form2.html");

});

//Define a summary route (328/diner/summary)
$f3->route('GET /summary', function () {

    //Write to Database


    //Instantiate a view
    $view = new Template();
    echo $view->render("views/order-summary.html");

    //Clear/destroy session array - removes newOrder object in session array
    session_destroy();


});



//Run Fat Free
$f3->run();