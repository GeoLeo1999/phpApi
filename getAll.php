<?php
 
require "./vendor/autoload.php";

$app = new Slim\App;

$app->get('/get/all',function($req, $res, array $args) {

    $con = new mysqli('localhost','root','','ClientDB');

    $query = $con->query("SELECT `id`,`username`,`first_name`,`last_name`,`email` FROM clients_table "); 
   
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
    return $res->withJson($data); 
});

$app->run();


?>