<?php
namespace App\Models;

use App\DataBase\Connection;


class UsersModel
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::createConnect();
    }

    public function createUserDB($reg_data)
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (login, email, password, age, data_registration) VALUES(?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $reg_data['reg_login'],
            $reg_data['reg_email'],
            $reg_data['reg_password'],
            $reg_data['reg_age'],
            $reg_data['reg_data']
        ]);
    }

    public function AuthUserDB(string $login,string  $password)
    {
        $stmt = $this->pdo->query('SELECT id FROM users WHERE login = "' . $login . '" AND password = "' . $password . '"');

        return $stmt->fetch();
    }

    public function userValidate($user)
    {
        $stmt = $this->pdo->query('SELECT id FROM users WHERE login = "' . $user . '"');

        return $stmt->fetch();
    }

    public function emailValidate($email)
    {
        $stmt = $this->pdo->query('SELECT id FROM users WHERE email = "' . $email . '"');

        return $stmt->fetch();
    }
}