<?php
include_once "db.php";
include_once "./generic-sql-to-json.php";
$basereq="SELECT * FROM type_de_biere";

// $extended=false;
// if((isset($_GET['_expand'])&&$_GET['_expand']=='')||(isset($_GET['_expandAll'])&&$_GET['_expandAll']=='')){
    
// }
// if((isset($_GET['_expand'])&&$_GET['_expand']=='')||(isset($_GET['_expandAll'])&&$_GET['_expandAll']=='')){
     
// }


if (!isset($valuesInPath[1]) || $valuesInPath[1] == "") {
    $stmt = $pdo->prepare($basereq);
} else {
   // if($extended){$basereq.=' AND';}
    $stmt = $pdo->prepare($basereq."WHERE id=?");
    $stmt->bindParam(1, $id);
}
$stmt->execute();
$res = $stmt->fetchAll();
$isArray=false;
if (!isset($valuesInPath[1]) || $valuesInPath[1] == "") {
   $isArray=true;
}
autoConvertExecutedStatementJsonOutput($res,$isArray);
header('HTTP/1.1 200 Ok');
