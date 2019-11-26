<?php
 require __DIR__ . '/vendor/autoload.php';
 require 'libs/NotORM.php'; 
 
 use \Slim\App;
 
 $app = new App();
 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
$app-> get('/simpanjawaban', function(){
    echo "API Biologi";
});


?>