<?php
error_reporting(E_ALL);
require_once 'vendor/autoload.php';
$exception = new App\Exceptions\ExceptionFileLog();
session_start();
print <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <link rel="stylesheet" href="public/css/main_style.css">
         <link rel="stylesheet" href="public/css/Auth/Auth.css">
         <script src="public/js/main_script.js"
    </head>
    <body>
         <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </body>
</html>
HTML;

try {
    require_once 'routes/routes.php';
} catch (Exception $e) {
    $exception->SetException($e->getMessage());
    echo '<script>alert("'.$e->getMessage().'");</script>';
    echo "<meta http-equiv='Refresh' content='0; URL=/'>";
}
