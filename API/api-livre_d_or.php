<?php
include_once './generic-sql-to-json.php';
function getStandaloneLivreDOr($id, $onlyKnoIfExist = false)
{

    //echo
    $req = "SELECT * FROM `livre_d_or` WHERE `id_livre_d_or`=" . $id;
    $stmt = $GLOBALS['pdo']->prepare($req);
    //$res=$stmt->fetchAll();
    if (!$onlyKnoIfExist) {
        executeAndConvertJSON($stmt, 'GET', $id);
    } else {
        $stmt->execute();
        $res = $stmt->fetchAll();
        //print_r($res);

        if (isset($res[0])) {
            return $res[0];
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
    $isExist = getStandaloneLivreDOr($id, true);
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
    case 'POST': //echo
        $basereq .= "INSERT INTO `livre_d_or`( `nom`, `prenom`, `email`, `telephone`, `note_accueil_services`, `note_proprete`, `note_qualite_produit`, `commentaire`, `validation_livre_d_or`) VALUES ( '"
        .str_replace("'", '\\\'', $postin->nom)."', " 
        .str_replace("'", '\\\'', $postin->prenom)."', '"
        .$postin->email."', '"
        .$postin->telephone."', "
        .$postin->note_accueil_services.", "
        .$postin->note_proprete.", "
        .$postin->note_qualite_produit.", '"
        .str_replace("'", '\\\'', $postin->commentaire)."', "
        .$postin->validation_livre_d_or.");";
        break;
    case 'PUT': //echo
        $basereq .= "UPDATE `livre_d_or` SET `nom`='"
        .str_replace("'", '\\\'', $postin->nom)."',`prenom`='"
        .str_replace("'", '\\\'', $postin->prenom)."',`email`= '"
        .str_replace("'", '\\\'', $postin->email)."', `telephone`='"
        .$postin->telephone."', `note_accueil_service`='"
        .$postin->note_accueil_service."', `not_proprete`='"
        .$postin->note_proprete."', `note_qualite_produit`='"
        .$postin->note_qualite_produit."', `commentaire`='"
        .$postin->commentaire."', `validation_livre_d_or`='"
        .$postin->validation_livre_d_or."' WHERE id_livre_d_or=" . $id;
        break;
    case 'PATCH':
        $basereq .= "UPDATE `livre_d_or` SET ";
        $o2arr = (Array) $postin;
        //print_r($o2arr);
        foreach ($o2arr as $key => $value) {
            # code...
            $basereq .= $key . "='" . $value . "' ,";
        }
        $basereq = substr($basereq, 0, strlen($basereq) - 2);
        echo $basereq .= " WHERE id_livre_d_or=" . $id;
        break;

    case 'DELETE': //echo
        $basereq .= "DELETE FROM livre_d_or WHERE id_livre_d_or=" . $id;
        break;
    case 'GET':$basereq .= "SELECT * FROM livre_d_or ";
        if ($id != '') {$basereq .= "WHERE id_livre_d_or=" . $id;}
        //echo $basereq;
        break;
}
$deleteRes = null;
//recuperation pour renvoie de l'objet supprimé
if ($method == 'DELETE') {
   $deleteRes=getStandaloneLivreDOr($id,true);
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
