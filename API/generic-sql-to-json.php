<?php

function autoConvertExecutedStatementJsonOutput($result, $isArray)
{
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
}
