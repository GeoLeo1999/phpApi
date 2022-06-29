<?php
 
require "./vendor/autoload.php";

$app = new Slim\App;

$app->get('/search/{usernmame}',function($req, $res, array $args) {

    $usernmame = $args['usernmame'];

    $con = new mysqli('localhost','root','','ClientDB');

    $query = $con->query("SELECT `id`,`username`,`first_name`,`last_name`,`email` FROM clients_table  WHERE username = '$usernmame'"); 
   
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
    return $res->withJson($data); 
});

$app->run();


?>
