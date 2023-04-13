<?php
include_once './generic-sql-to-json.php';
function getStandaloneTypeBiere($id, $onlyKnoIfExist = false)
{

    //echo
    $req = "SELECT * FROM type_de_biere WHERE `id_type_biere`=" . $id;
    $stmt = $GLOBALS['pdo']->prepare($req);
    //$res=$stmt->fetchAll();
    if (!$onlyKnoIfExist) {
        executeAndConvertJSON($stmt, 'GET', $id);
    } else {
        $stmt->execute();
        $res = $stmt->fetchAll();
        //print_r($res);

        if (isset($res[0])) {
            return $res;
        } 
        else {
            return false;
        }

    }
}
$basereq = '';
//recuperation de la methode
$method = $_SERVER['REQUEST_METHOD'];
$id = '';
if (!isset($valuesInPath[1]) || $valuesInPath[1] == "") {
    if ($method == 'DELETE' || $method == 'PUT' || $method == 'PATCH') {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }
} else { //post interdit la presence d'id
    if ($method == 'POST') {
        header('HTTP/1.1 401 Unauthorized');
        exit();
    }

    $id = $valuesInPath[1];
    $isExist = getStandaloneTypeBiere($id, true);
    if (!$isExist) {
        header('HTTP/1.1 404 Not Found');
        echo '{}';
        exit();
    }
}

//recupareation du content
if ($method == 'PUT' || $method == 'PATCH' || $method == 'POST') {
    try {
        $postin = json_decode(file_get_contents("php://input"));
    } catch (Exception $ex) {
        header('HTTP/1.1 500 Internal Server Error');
        echo '{}';
        exit();
    }
}
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $basereq .= "INSERT INTO `type_de_biere`(`couleur`) VALUES ('".str_replace("'", '\\\'', $postin->couleur)."');";
        break;
    case 'PUT':
        $basereq .= "UPDATE `type_de_biere` SET `couleur`='"
        .str_replace("'", '\\\'', $postin->couleur)."' WHERE id_type_biere=" . $id;
        break;
    case 'PATCH':
        $basereq .= "UPDATE `type_de_biere` SET ";
        $o2arr = (Array) $postin;
        //print_r($o2arr);
        foreach ($o2arr as $key => $value) {
            # code...
            $basereq .= $key . "='" . $value . "' ,";
        }
        $basereq = substr($basereq, 0, strlen($basereq) - 2);
        echo $basereq .= " WHERE id_type_biere=" . $id;
        break;

    case 'DELETE': //echo
        $basereq .= "DELETE FROM type_de_biere WHERE id_type_biere=" . $id;
        break;
    case 'GET':$basereq .= "SELECT * FROM type_de_biere ";
        if ($id != '') {$basereq .= "WHERE id_type_biere=" . $id;}
        //echo $basereq;
        break;
}
$deleteRes = null;
//recuperation pour renvoie de l'objet supprimé
if ($method == 'DELETE') {
   $deleteRes=getStandaloneTypeBiere($id,true);
   
}

$stmt = $pdo->prepare($basereq);

$valueReturned = executeAndConvertJSON($stmt, $method, $id);

if ($method == 'POST' || $method == 'PUT' || $method == 'PATCH') {
    getStandaloneLivreDOr($valueReturned);
    //print_r('get last id');
    if ($method == 'POST') {
        header('HTTP/1.1 201 Created');
        exit();
    }
} else if ($method == 'DELETE') {
    autoConvertExecutedStatementJsonOutput($deleteRes, false);
}
header('HTTP/1.1 200 Ok');
