<?php
namespace App\Http\Middleware;

class AuthTokenForm
{
    private $token;
    /**
     * AuthTokenForm constructor.
     * @param $token
     */
    public function __construct()
    {

    }

    public function getToken()
    {
        $random_int = rand(12342, 99999529);
        $token_hash = hash('sha256', $random_int, $raw_output = FALSE);
        $_SESSION['token'] = $token_hash;

        return $token_hash;
    }

    public function VerifyToken($token)
    {
        if ($token === $_SESSION['token']) {
            return true;
        } else {
            return false;
        }
    }
}