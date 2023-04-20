<?php

function read_json_file($file_path) {
    $json_data = file_get_contents($file_path);
    return json_decode($json_data, true);
}

function write_json_file($file_path, $data) {
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($file_path, $json_data);
}

?>