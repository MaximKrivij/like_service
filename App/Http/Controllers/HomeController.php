<?php


namespace App\Http\Controllers;


class HomeController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('resources/views');
        $twig = new \Twig\Environment($loader);

        $twig->display('home.twig.php', array('SESSION_LOGIN' => $_SESSION['login']));
    }
}