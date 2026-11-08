<?php
    $conn = mysqli_connect("localhost", "root", "", "activity1f");

     function h($str) {
        return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
    }
    
    session_start();
?>