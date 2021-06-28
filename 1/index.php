<?php

//Делаю неуникальное значение
$arrA[8] = 5;

//Набираю массив с пропуском уже присвоенного значения
for($i = 1; $i <= 1000000; $i++) {
    if ($i !== 8) {
        $arrA[$i] = $i;
    }
}

//Исходя из найденных тестов, даже две функции array_flip() работают быстрее одной array_unique()
$arrB = array_flip(array_flip($arrA));
$res = array_values(array_diff_key($arrA, $arrB));

print_r($res[0]);
