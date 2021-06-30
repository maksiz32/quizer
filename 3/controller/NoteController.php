<?php

require_once 'model/NoteProvider.php';
$pdo = require ROOT . '/dbconnect.php';

$post = json_decode(file_get_contents('php://input'), true);

if(isset($post['mail']) && isset($post['phone'])) {
    $arr = (new NoteProvider($pdo))->action($post);
    $r = json_encode($arr, JSON_UNESCAPED_UNICODE);
            echo $r;
            die();
} else {
    $arr = [
        'res' => 0,
        'error' => 'Введены не все данные'
    ];
    $r = json_encode($arr, JSON_UNESCAPED_UNICODE);
            echo $r;
            die();
}