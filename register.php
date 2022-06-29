<?php

use Slim\Http\Request;
use Slim\Http\Response;
 
require "./vendor/autoload.php";

$app = new Slim\App;


$app->post('/register',function($req, $res, array $args) {
    
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

    $salt = "1999";
    $saltedPass = "MD5('" . $input['password'] . $salt . "')";
    $qpass = $saltedPass;

  
    $my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO clients_table (username, first_name, last_name, email, password) VALUES (:username, :first_name, :last_name, :email, $qpass)");

    $my_Insert_Statement->bindParam("username", $input['username']);
    $my_Insert_Statement->bindParam("first_name", $input['first_name']);
    $my_Insert_Statement->bindParam("last_name", $input['last_name']);
    $my_Insert_Statement->bindParam("email", $input['email']);


    if ($my_Insert_Statement->execute()) {
      echo " - New record created successfully";
    } else {
      echo " - Unable to create record";
    }


});

$app->run();

