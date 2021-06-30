<?php

trait ValidateTrait
{
    private function validatePhone(string $phone): bool
    {
        //Потом можно усложнить проверку полученных данных
        return (empty($phone) || is_null($phone)) ? false : true;
    }

    private function validateMail(string $mail): bool
    {
        return (empty($mail) || is_null($mail)) ? false : true;
    }
}