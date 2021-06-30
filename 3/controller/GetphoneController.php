<?php

require_once 'model/PhoneProvider.php';
$pdo = require ROOT . '/dbconnect.php';

$post = json_decode(file_get_contents('php://input'), true);

if (isset($post['mail'])) {
    $arr = (new PhoneProvider($pdo))->getPhonesByEmail($post['mail']);
    $r = json_encode($arr, JSON_UNESCAPED_UNICODE);
    echo $r;
    die();
}