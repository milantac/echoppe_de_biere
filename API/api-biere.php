<?php


$basereq="SELECT * FROM biere";

include_once 'generic-sql-to-json.php';
if (!isset($valuesInPath[1]) || $valuesInPath[1] == "") {
    $stmt = $pdo->prepare($basereq);
} else {
   // if($extended){$basereq.=' AND';}
    $stmt = $pdo->prepare($basereq." WHERE id_biere=?");
    $stmt->bindParam(1, $id);
}
executeAndConvertJSON($stmt);