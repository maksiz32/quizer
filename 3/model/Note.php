<?php

class Note 
{
    private string $mail;
    private string $phone;

    public function __construct(string $mail, string $phone)
    {
        $this->mail = $mail;
        $this->phone = $phone;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }
}