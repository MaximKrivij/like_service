<?php

namespace App\Http\Middleware;

use Exception;

class FormValidator
{
    function cleanValidator(string $value) //функция принимает на вход строку
    {
        $value = trim($value);  //trim для удаления пробелов из начала и конца строки.
        $value = stripslashes($value);  //Функция stripslashes нужна для удаления экранированных символов
        $value = strip_tags($value);  //Функция strip_tags нужна для удаления HTML и PHP тегов
        $value = htmlspecialchars($value);  //функция - htmlspecialchars преобразует специальные символы в HTML-сущности ('&' преобразуется в '&amp;' и т.д.)

        if (!empty($value)) {  //Если не пустое значение...
            return $value;
        } else {
            throw new Exception('Некоректные данные!');
        }
    }

    public function checkLengthValidator(string $value, int $min, int $max)  //функция принимает на вход(строку, мин/значение, макс/значение_строки)
    {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max); //mb_strlen для проверки длинны строки

        if (!$result == true) {
            return $value;
        } else {
            throw new Exception('Длина поля должна быть от ' . $min . ' до ' . $max . ' символов!');
        }
    }

    public function emailValidator(string $email)
    {
        $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);  //filter_var с параметром FILTER_VALIDATE_EMAIL для валидации электронного адреса.

        if ($email_validate != false) {
            return $email_validate;
        } else {
            throw new Exception('Некорректно введен email!');
        }
    }

    public function PasswordComparison(string $password1, string $password2)
    {
        if ($password1 === $password2) {
            return true;
        } else {
            throw new Exception('Пароли Не совпадают!');
        }
    }

    public function RegularExpression(string $value, string $parameter)
    {
        /*
         * @var value = input text
         * @var parameter = 'ru' проверяет русскоязычный ли текст
         * @var parameter = 'en' проверяет англоязычный ли текст
         * @var parameter = 'symbol' проверяет поле на запрещенные символы
         */

        if ($parameter === 'ru') {
            $result = preg_match('/[А-Яа-я0-9Ёёіїє]/iu', $value);
            if ($result == true) {
                return true;
            } else {
                throw new Exception('Символы должны быть на кириллице!');
            }
        }

        if ($parameter === 'en') {
            $result = preg_match('/[A-Za-z0-9]/iu', $value);
            if ($result == true) {
                return true;
            } else {
                throw new Exception('Символы должны быть латинские!');
            }
        }

        if ($parameter === 'symbol') {
            if (!preg_match("/[\||\'|\<|=%:.,๑ღεзφɔ;№^\>|\[|\]|\"|\!|\?|\$|\@|\#|\/|\\\|\&\~\*\{\+]/", $value)) { //Проверяет есть ли запрещенные символы, если нет, то...
                return true;
            } else {
                throw new Exception('Вы ввели недопустимые  символы!');
            }
        }
    }
}