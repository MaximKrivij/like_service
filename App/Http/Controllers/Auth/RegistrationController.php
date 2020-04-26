<?php


namespace App\Http\Controllers\Auth;
use Exception;
use App\Http\Middleware\FormValidator;
use App\Http\Middleware\AuthTokenForm;
use App\Models\UsersModel;

class RegistrationController
{
    public function regUser()
    {
        $token = new AuthTokenForm();

        $form_validator = new FormValidator();
        if (isset($_POST['reg_login']) and isset($_POST['reg_email']) and isset($_POST['reg_age'])
            and isset($_POST['reg_password']) and isset($_POST['reg_password2']) and isset($_POST['reg_submit'])) {
            if (!empty($_POST['token']) and !empty($_POST['reg_login']) and !empty($_POST['reg_email'])
                and !empty($_POST['reg_age']) and !empty($_POST['reg_password']) and !empty($_POST['reg_password2'])) {
                $verify_token = $_POST['token'];
                if ($token->VerifyToken($verify_token) == true) {
                    $reg_login = $_POST['reg_login'];
                    $reg_email = $_POST['reg_email'];
                    $reg_age = $_POST['reg_age'];
                    $reg_password = $_POST['reg_password'];
                    $reg_password2 = $_POST['reg_password2'];
                    $data_registration = date("Y-m-d H:i:s");

                    $form_validator->cleanValidator($reg_login);
                    $form_validator->cleanValidator($reg_email);
                    $form_validator->cleanValidator($reg_age);
                    $form_validator->cleanValidator($reg_password);
                    $form_validator->cleanValidator($reg_password2);

                    $form_validator->checkLengthValidator($reg_login, 3, 15);
                    $form_validator->checkLengthValidator($reg_email, 5, 35);
                    $form_validator->checkLengthValidator($reg_age, 1, 3);
                    $form_validator->checkLengthValidator($reg_password, 6, 64);
                    $form_validator->checkLengthValidator($reg_password2, 6, 64);

                    $form_validator->emailValidator($reg_email);

                    $form_validator->PasswordComparison($reg_password, $reg_password2);

                    $form_validator->RegularExpression($reg_login,'symbol');
                    $form_validator->RegularExpression($reg_age,'symbol');
                    $form_validator->RegularExpression($reg_password,'symbol');
                    $form_validator->RegularExpression($reg_password2,'symbol');

                    $form_validator->RegularExpression($reg_login,'en');
                    $form_validator->RegularExpression($reg_age,'en');
                    $form_validator->RegularExpression($reg_password,'en');
                    $form_validator->RegularExpression($reg_password2,'en');

                    $reg_password_hash = hash('sha256', $reg_password, $raw_output = FALSE);

                    $set_user = new UsersModel();

                    if ($set_user->userValidate($reg_login) != false) {
                        throw new Exception('Пользователь с таким Логином уже зарегистрирован!');
                    }
                    if ($set_user->emailValidate($reg_email) != false) {
                        throw new Exception('Пользователь с таким Email уже зарегистрирован!');
                    }

                    $reg_data['reg_login'] = $reg_login;
                    $reg_data['reg_email'] = $reg_email;
                    $reg_data['reg_age'] = $reg_age;
                    $reg_data['reg_password'] = $reg_password_hash;
                    $reg_data['reg_data'] = $data_registration;

                    $set_user->createUserDB($reg_data);

                    echo "<meta http-equiv='Refresh' content='0; URL=/'>";

                } else {
                    throw new Exception('Что-то пошло не так!');
                }
            } else {
                throw new Exception('Все поля должны быть заполнены!');
            }
        }
    }
}