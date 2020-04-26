<?php
namespace App\Http\Controllers;
use Exception;
use App\Http\Middleware\AuthTokenForm;
error_reporting('E_ALL');


class MainController
{
    public function mainIndex()
    {
        $token = new AuthTokenForm();

        $loader = new \Twig\Loader\FilesystemLoader('resources/views');
        $twig = new \Twig\Environment($loader);

        $twig->display('main.twig.php',array('token'=>$token->getToken(),'SESSION_LOGIN' => $_SESSION['login']));
    }

}

