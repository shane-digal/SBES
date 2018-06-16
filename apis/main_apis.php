<?php 
    include "../includes/module.php";
    include "Db.php";
    $q = (isset($_POST['q']) ? $_POST['q'] : $_GET['q']);
    $isTest = (isset($_GET['test']) ? $_GET['test'] : false);
    $db = new Db();
    $con = $db->connectMySqli();

    $response['values'] = "";
    $response['message'] = "";
    $message = "";
    $json_value = "";
    
    include 'routes/api_employees.php';

    $response['message'] = $message ;
    $response['values'] = $json_value;
    if($isTest){
        // json_encode($response['values']);
    }

    die(json_encode($response));