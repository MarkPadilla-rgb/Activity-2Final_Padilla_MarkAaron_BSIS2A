<?php
 require_once "connect.php";

 $messages = [];
 $errors = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if($password !== $confirm_password){
            $errors[] = "Passwords do not match.";
        }else{
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $uname, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if($stmt->affected_rows > 0){
            $messages[] = "Registration successful. Please wait for account approval.";
        }else{
            $errors[] = "Registration failed. Please try again.";
        }
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
        <h1>Create your account</h1>
        <p class="intro">Join Banana Len. Your account will be ready after approval.</p>
    <?php foreach($errors as $e):?>
        <p class="form-feedback error"><?=h($e)?></p>
    <?php endforeach;?>
    <?php foreach($messages as $m):?>
        <p class="form-feedback success"><?=h($m)?></p>
    <?php endforeach;?>
    <form action="" method="post">
        <div class="form-field">
            <label for="uname">Username</label>
            <input type="text" id="uname" name="uname" placeholder="Choose a username" required autofocus>
        </div>
        <div class="form-field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create a password" required>
        </div>
        <div class="form-field">
            <label for="confirm_password">Confirm password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your password again" required>
        </div>
        <button class="button" type="submit">Create account</button>
    </form>
    <p class="auth-footer">Already have an account? <a href="index.php">Sign in</a></p>
    </main>
</body>
</html>