<?php 
    require_once "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginh.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login Form</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="action/action_login.php" method="POST" name="login">
            <div class="form-group">
                <label for="username">Email :</label>
                <i class='bx bxs-user'></i>
                <input type="text" name="email" placeholder="Masukan email" required>
            </div>
            <div class="form-group">
                <label for="password">Password :</label>
                <i class='bx bxs-lock-alt'></i>
                <input type="password" name="password"  placeholder="Masukan password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
            <p>Belum Punya Akun?<a href="register.php"> Register</a></p>
        </form>
    </div>
</body>
</html>

