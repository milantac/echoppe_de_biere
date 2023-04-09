<?php
$basereq="SELECT * FROM type_de_biere";

if (!isset($id)) {
    $stmt = $pdo->prepare($basereq);
} else {
   // if($extended){$basereq.=' AND';}
    $stmt = $pdo->prepare($basereq." WHERE id_type_biere=:id");
    $stmt->bindParam(':id', $id);
}
include_once 'generic-sql-to-json.php';
executeAndConvertJSON($stmt);