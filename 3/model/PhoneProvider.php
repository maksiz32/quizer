<?php

require_once 'model/ValidateTrait.php';

class PhoneProvider
{
    use ValidateTrait;

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getPhonesByEmail(string $mail): array {
        if ($this->validateMail($mail)) {
            if ($this->countMail($mail) > 0) {
                $id = $this->getMailId($mail);
                $statement = $this->pdo->prepare('SELECT phone FROM phones WHERE idMail = :idMail');
                    $statement->execute([
                        'idMail' => $id
                    ]);
                $res = $statement->fetchall(PDO::FETCH_ASSOC);
                $result = '';
                foreach ($res as $response) {
                    $result .= $response['phone'] . " ";
                }

                return [
                    'res' => 1,
                    'mes' => $result
                ];
            } else {
                return [
                    'res' => 0,
                    'error' => 'Email не найден'
                ];
            }
        } else {
            return [
                'res' => 0,
                'error' => 'Неверный ввод'
            ];
        }
    }

    private function getMailId (string $mail): int
    {
        $statement = $this->pdo->prepare('SELECT id FROM mails WHERE mail = :mail');
                    $statement->execute([
                        'mail' => $mail
                    ]);
        return $statement->fetch(PDO::FETCH_ASSOC)['id'];
    }

    private function countMail(string $mail): int
    {
        $statement = $this->pdo->prepare('SELECT COUNT(*) FROM mails WHERE mail = :mail');
                    $statement->execute([
                        'mail' => $mail
                    ]);
                    $res = $statement->fetch(PDO::FETCH_ASSOC);
        return $res['COUNT(*)'];
    }
}