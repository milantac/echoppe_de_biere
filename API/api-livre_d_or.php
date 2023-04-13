<?php
 
$basereq = "SELECT * FROM livre_d_or";

if (!isset($valuesInPath[1]) || $valuesInPath[1] == "") {
    $stmt = $pdo->prepare($basereq);
} else {
   // if($extended){$basereq.=' AND';}
    $stmt = $pdo->prepare($basereq." WHERE id_livre_d_or=?");
    $stmt->bindParam(1, $id);
}
include_once 'generic-sql-to-json.php';
OLDexecuteAndConvertJSON($stmt);