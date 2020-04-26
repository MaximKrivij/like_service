<?php

namespace App\Http\Controllers\Auth;
use Exception;
use App\Http\Middleware\FormValidator;
use App\Http\Middleware\AuthTokenForm;
use App\Models\UsersModel;
class LoginController
{
    public function authLogin()
    {
        $token = new AuthTokenForm();

        $verify_user = new UsersModel();

        $loader = new \Twig\Loader\FilesystemLoader('resources/views');
        $twig = new \Twig\Environment($loader);

        if (isset($_POST['login']) and isset($_POST['password'])) {
            if (!empty($_POST['token']) and !empty($_POST['login']) and !empty($_POST['password'])) {
                $verify_token = $_POST['token'];
                if ($token->VerifyToken($verify_token) == true) {
                    $login = $_POST['login'];
                    $password = $_POST['password'];

                    $form_validator = new FormValidator();

                    $form_validator->cleanValidator($login);
                    $form_validator->cleanValidator($password);

                    $form_validator->checkLengthValidator($login, 3, 15);
                    $form_validator->checkLengthValidator($password, 6, 25);

                    $form_validator->RegularExpression($login,'en');
                    $form_validator->RegularExpression($password,'en');
                    $form_validator->RegularExpression($login,'symbol');
                    $form_validator->RegularExpression($password,'symbol');

                    $password_hash = hash('sha256', $password, $raw_output = FALSE);

                    if ($verify_user->AuthUserDB($login, $password_hash) == true) {
                        $_SESSION['login'] = $login;

                        echo "<meta http-equiv='Refresh' content='0; URL=/home'>";
                    } else {
                        throw new Exception('Логин или Пароль Не совпадают!');
                    }
                } else {
                    throw new Exception('Что-то пошло не так!');
                }
            } else {
                throw new Exception('Все поля должны быть заполнены!');
            }
        }
    }
}