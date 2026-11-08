<?php
    require_once "connect.php";

    if(!isset($_SESSION['user_id']) && !isset($_SESSION['role']) && !isset($_SESSION['username'])){
        header("Location: index.php");
    }


    $productid = $_GET['productid'];

    $delete = mysqli_query($conn, "DELETE FROM products WHERE ID = '$productid'");

    if($delete){
        echo "<script>alert('Product deleted successfully.'); window.location.href='storage.php';</script>";
    } else {
        echo "<script>alert('Something went wrong, please check or try again later.'); window.location.href='storage.php';</script>";
    }
?>    