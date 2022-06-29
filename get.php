<?php
 
require "./vendor/autoload.php";

$app = new Slim\App;

$app->get('/id/{id}',function($req, $res, array $args) {

    $id = $args['id'];

    $con = new mysqli('localhost','root','','ClientDB');

    $query = $con->query("SELECT * FROM clients_table WHERE id = $id"); 
   
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
    return $res->withJson($data); 
});

$app->run();


?>