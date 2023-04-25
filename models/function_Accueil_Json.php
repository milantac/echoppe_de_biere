<?php

function read_json_file($file_path) {
    if (file_exists($file_path)) {
        $json_content = file_get_contents($file_path);
        return json_decode($json_content, true);
    }
    return null;
}

function write_json_file($file_path, $data) {
    $json_content = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($file_path, $json_content);
}


?>