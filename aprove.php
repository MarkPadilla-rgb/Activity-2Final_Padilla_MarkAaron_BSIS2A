<?php
    require_once "connect.php";

    if(!isset($_SESSION['user_id']) && !isset($_SESSION['role']) && !isset($_SESSION['username'])){
        header("Location: index.php");
    }


    if($_SESSION['role'] !== 'admin'){
        header("Location: home.php");
    }

    $userid = $_GET['userid'];

    $approveuser = mysqli_query($conn, "UPDATE users SET status = 'approved' WHERE ID = '$userid'");

    if($approveuser){
        echo "<script>alert('User approved successfully.'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error approving user.'); window.location.href='profile.php';</script>";
    }
?>    