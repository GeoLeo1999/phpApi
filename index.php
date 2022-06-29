<?php

include "config.php";
 
require "./vendor/autoload.php";

$app = new Slim\App();

$app->get('/',function($req, $res) {

    $con = new mysqli('localhost','root','','ClientDB');

    $query = $con->query("SELECT * FROM clients_table"); 
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
    return $res->withJson($data); 
});


$app->run();


?>