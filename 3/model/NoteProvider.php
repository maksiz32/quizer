<?php

require_once 'model/Note.php';
require_once 'model/ValidateTrait.php';

class NoteProvider
{
    use ValidateTrait;

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function action(array $post): array
    {
        if($this->validateMail($post['mail']) && $this->validatePhone($post['phone'])) {
            $note = new Note($post['mail'], $post['phone']);
            if ($this->countPhone($post['phone']) < 1) {
                if ($this->countMail($post['mail']) > 0) {
                    //addPhoneToNote
                    $statement = $this->pdo->prepare('SELECT id FROM mails WHERE mail = :mail LIMIT 1');
                    $statement->execute([
                        'mail' => $post['mail']
                    ]);
                    $res = $statement->fetch(PDO::FETCH_ASSOC);

                    $statement = $this->pdo->prepare("INSERT INTO `phones` (phone, idMail) 
                                            VALUES (:phone, :idMail)");
                    $statement->execute([
                        'phone' => $note->getPhone(),
                        'idMail' => $res['id']
                    ]);
                    $statement->fetch(PDO::FETCH_ASSOC);

                    return [
                        'res' => 1,
                        'mes' => 'Номер добавлен к почте'
                    ];
                } else {
                    //createNewNote
                    $statement = $this->pdo->prepare("INSERT INTO `mails` (mail) 
                                            VALUES (:mail)");
                    $statement->execute([
                        'mail' => $note->getMail()
                    ]);
                    $statement->fetch(PDO::FETCH_ASSOC);
                    $res = (int) $this->pdo->lastInsertId();
                    // var_dump($res);
                    
                    $statement = $this->pdo->prepare("INSERT INTO `phones` (phone, idMail) 
                                            VALUES (:phone, :idMail)");
                    $statement->execute([
                        'phone' => $note->getPhone(),
                        'idMail' => $res
                    ]);
                    $r = $statement->fetch(PDO::FETCH_ASSOC);
                    
                    return [
                        'res' => 1,
                        'mes' => 'Номер и почта добавлены'
                    ];
                }
            } else {
                return [
                    'res' => 0,
                    'error' => 'Номер уже привязан к почте'
                ];
            }

        } else {
            return [
                'res' => 0,
                'error' => 'Неверный ввод'
            ];
        }
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

    private function countPhone(string $phone): int
    {
        $statement = $this->pdo->prepare('SELECT COUNT(*) FROM phones WHERE phone = :phone');
                    $statement->execute([
                        'phone' => $phone
                    ]);
                    $res = $statement->fetch(PDO::FETCH_ASSOC);
        return $res['COUNT(*)'];
    }
}