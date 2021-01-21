<?php
    session_start();
    session_destroy();

    header("Location: http://localhost:63342/UTSPBO2FINALE/user/login.php");
?>