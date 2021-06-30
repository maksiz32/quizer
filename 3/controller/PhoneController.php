<?php

require_once 'model/PhoneProvider.php';
$pdo = require ROOT . '/dbconnect.php';


if (isset($_POST['mail'])) {
    $arr = (new PhoneProvider($pdo))->getPhonesByEmail($_POST['mail']);
    $r = json_encode($_POST, JSON_UNESCAPED_UNICODE);
    echo $r;
    die();
} else {
    $pageName = 'Главная страница';
    require_once 'view/phone.php';
}