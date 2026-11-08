<?php
    require_once "connect.php";

    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
    exit();
?>