<?php
require_once "db.php";
$GLOBALS['pdo']=$pdo;
function OLDexecuteAndConvertJSON(PDOStatement $preparedStatement)
{
    try {
        $preparedStatement->execute();
        print_r( //$preparedStatement);
            $preparedStatement->errorInfo());
    } catch (Exception $ex) {print_r($ex);}
    $res = $preparedStatement->fetchAll();
    $isArray = false;
    $paths = explode('/', $_GET['_path']);
    if (!isset($paths[1])) {
        $isArray = true;}
    autoConvertExecutedStatementJsonOutput($res, $isArray);
    header('HTTP/1.1 200 Ok');
}
function executeAndConvertJSON(PDOStatement $preparedStatement, $method, $id=-1)
{
    try {
        $preparedStatement->execute();
    } catch (Exception $ex) {
        header('HTTP/1.1 500 Internal Server Error');
        print_r($ex);
        exit();
    
    }
    if ($method == 'POST') {
        return $GLOBALS['pdo']->lastInsertId();
    } else if ($method != 'GET') {
        return $id;
    } else {
        $res = $preparedStatement->fetchAll();
        $isArray = false;
        //sortie en tableau ou en objet si ID present dans le path
        $paths = explode('/', $_GET['_path']);
        if (!isset($paths[1])) {
            $isArray = true;}
        autoConvertExecutedStatementJsonOutput($res, $isArray);
       // header('HTTP/1.1 200 Ok');
    }
}
function autoConvertExecutedStatementJsonOutput($result, $isArray)
{

    try {
        if ($isArray) {
            echo "[";
        }
        $nbresults = count($result);
        $y = 0;
        foreach ($result as $row) {
            foreach ($row as $key => $value) {
                if (is_numeric($key)) {
                    unset($row[$key]);
                }
            }
            $nbDeKey = count($row);
            $i = 0;
            echo '{';
            foreach ($row as $key => $value) {
                echo "\"" . $key . "\":";
                if (is_numeric($value)) {
                    echo $value;
                } else {
                    echo "\"" . str_replace(array("\r\n", "\n", "\r"), "\\n", $value) . "\"";
                }

                if ($nbDeKey > ++$i) {
                    echo ',';
                }
            }
            echo '}';
            if (++$y < $nbresults) {
                echo ',';
            }
        }

        if ($isArray) {
            echo "]";
        }
    } catch (Exception $ex) {
        header('HTTP/1.1 500 internal server error');
        exit();
    }
   // header('HTTP/1.1 200 Ok');
}
function getKeyList(Object $obj)
{
    return get_object_vars($obj);
}
function obj2array(&$Instance)
{
    $clone = (array) $Instance;

    return $clone;
}
