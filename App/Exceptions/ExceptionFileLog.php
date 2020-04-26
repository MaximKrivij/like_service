<?php

namespace App\Exceptions;

class ExceptionFileLog
{
    private $message;

    public function SetException($e)
    {
        fopen('app/Exceptions/log_exception_file.txt', 'a+');

        $file = 'app/Exceptions/log_exception_file.txt';

        if (file_exists($file)) {
            $current = file_get_contents($file);
            $current .= date('l jS \of F Y h:i:s A' . PHP_EOL);
            $current .= $e . PHP_EOL;
            $current .= '---------------------------------------------------------------';
            // Пишем содержимое  в файл
            file_put_contents($file, $current . PHP_EOL);
        }
    }
}