<?php
 require_once "connect.php";

 $errors = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $uname = $_POST['uname'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        $stmt->close();

        if($user && $password === $user['password']){
            if($user['status'] !== "approved"){
                $errors[] = "Your account is not approved yet.";
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: home.php");
                exit();
            }
        } else {
            $errors[] = "Invalid username or password.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana Len</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
    <main class="auth-card">
        <div class="brand-mark" aria-hidden="true">🍌</div>
        <h1>Welcome back</h1>
        <p class="intro">Sign in to continue to Banana Len.</p>
    <?php foreach($errors as $e):?>
        <p class="form-feedback error"><?=h($e)?></p>
    <?php endforeach;?>
    <form action="" method="post">
        <div class="form-field">
            <label for="uname">Username</label>
            <input type="text" id="uname" name="uname" placeholder="Enter your username" required autofocus>
        </div>
        <div class="form-field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button class="button" type="submit">Sign in</button>
    </form>
    <p class="auth-footer">Don't have an account? <a href="register.php">Create one</a></p>
    </main>
</body>
</html>