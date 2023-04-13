<?php
/*function checkApiKeyInHeader($header)
{
return true;
}*/
$DEBUG = true;
if ($DEBUG) {
    //  print_r($_GET);
    //  print_r($_SERVER);
  }
if (!isset($_GET["_path"]) || $_GET["_path"] == "") {
    include "./main-page.php";
    exit();
}

$header = getallheaders();
//verif de l'existance d'une api key si pas en mode debug
if ($DEBUG == false && (!isset($header['API-TOKEN']))) {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}
/*
//include("./authent.php") ;
//ici tu peux faire ta verification soit par clef que tu fournit a chaque user avec une verif de concordance db ou par $_cookie
if (checkApiKeyInHeader($header)) {
//si pas ou mal authent
header('HTTP/1.1 401 Unauthorized');
exit();
}
 */


$valuesInPath = explode('/', $_GET['_path']);
if(isset($valuesInPath[1])){
     $id=$valuesInPath[1];
}
$header = getallheaders();
include_once './db.php';
switch ($valuesInPath[0]) {
    case 'biere':
        include 'api-biere.php';
        break;  
        case 'livre_d_or':
        include 'api-livre_d_or.php';
        break;
    case 'type_de_biere':
        include 'api-type_de_biere.php';
        break;
    default:
        include 'main-page.php';
        exit();
}


