<?php
include_once "db.php";
function executeAndConvertJSON($preparedStatement)
{
    $preparedStatement->execute();
    $res = $preparedStatement->fetchAll();
    $isArray = false;
    $paths=explode('/', $_GET['_path']);
    if (!isset($paths[1])) {
        $isArray = true;}
    autoConvertExecutedStatementJsonOutput($res, $isArray);
    header('HTTP/1.1 200 Ok');
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
    header('HTTP/1.1 200 Ok');
}
