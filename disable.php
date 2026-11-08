<?php
    require_once "connect.php";

    if(!isset($_SESSION['user_id']) && !isset($_SESSION['role']) && !isset($_SESSION['username'])){
        header("Location: index.php");
    }


    if($_SESSION['role'] !== 'admin'){
        header("Location: home.php");
    }

    $userid = $_GET['userid'];

    $approveuser = mysqli_query($conn, "UPDATE users SET status = 'pending' WHERE ID = '$userid'");

    if($approveuser){
        echo "<script>alert('User has been succefully disable.'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error disable user.'); window.location.href='profile.php';</script>";
    }
?>    