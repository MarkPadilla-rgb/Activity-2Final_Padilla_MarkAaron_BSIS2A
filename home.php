<?php
     require_once "connect.php";

     if($_SESSION['role'] === '' || $_SESSION['user_id'] === ''){
         header("Location: index.php"); 
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Banana Len</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a class="site-brand" href="home.php"><span class="brand-mark" aria-hidden="true">🍌</span> Banana Len</a>
            <nav class="nav" aria-label="Main navigation">
                <a href="home.php" aria-current="page">Home</a>
                <a href="storage.php">Storage</a>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="profile.php">Profile</a>
                <?php endif; ?>
                <a href="logout.php">Log out</a>
            </nav>
        </div>
    </header>
    <main class="page-content">
        <section class="page-card">
            <p class="eyebrow">Banana Len Management System</p>
            <h1>Welcome to Banana Len</h1>
            <p>Your workspace for managing storage and keeping your account details close at hand.</p>
        </section>
    </main>
</body>
</html>