<?php

session_start();

if (isset($_POST['out'])) {
    unset($_SESSION['login']);
    echo "<meta http-equiv='Refresh' content='0; URL=/'>";
}