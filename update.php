<?php

use Slim\Http\Request;
use Slim\Http\Response;
 
require "./vendor/autoload.php";

$app = new Slim\App;


$app->post('/update',function($req, $res, array $args) {
    
    $servername = "localhost";
    $database = "ClientDB"; 
    $username = "root";
    $password = "";

 
    $sql = "mysql:host=$servername;dbname=$database;";
    $dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    // Create a new connection to the MySQL database using PDO, $my_Db_Connection is an object
    try { 
    $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
    echo "Connected successfully";
    } catch (PDOException $error) {
    echo 'Connection error: ' . $error->getMessage();
    }

    $input = (array)$req->getParsedBody();
    if ($input['option'] == 'password'){
      $salt = "1999";
      $saltedPass = "MD5('" . $input['data'] . $salt . "')";
      $qoption = $input['option'];
      $qdata = $saltedPass;
      $qid = $input['id'];
      $my_Update_Statement = $my_Db_Connection->prepare(" UPDATE clients_table SET $qoption= $qdata WHERE id= '$qid'");
    }else{
      $qoption = $input['option'];
      $qdata = $input['data'];
      $qid = $input['id'];
      $my_Update_Statement = $my_Db_Connection->prepare(" UPDATE clients_table SET $qoption= '$qdata' WHERE id= '$qid'");
    }
    
    

    if ($my_Update_Statement->execute()) {
      echo " - record updated successfully";
    } else {
      echo " - Unable to update record";
    }


});

$app->run();