<?php

// Database settings
$db="echoppe_de_biere";
$dbhost="localhost";
$dbport=3306;
$dbuser="root";
$dbpasswd="";
 
try{$pdo = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.'', $dbuser, $dbpasswd);
$pdo->exec("SET CHARACTER SET utf8");
}catch(Exception $ex){print_r($ex);}
 
?>