<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'] ?? '';
    json_decode($data);
    if (json_last_error() === JSON_ERROR_NONE) {
        file_put_contents('games.json', $data);
        echo 'success';
    } else {
        echo 'error: invalid JSON';
    }
}
?>