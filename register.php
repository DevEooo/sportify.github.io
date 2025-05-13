<?php 
require_once "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registerh.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Register Form</title>
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <form action="action/action_register.php" method="POST">
            <div class="form-group">
                <label for="name">Nama Lengkap:</label>
                <i class='bx bxs-user'></i>
                <input type="text" name="name" placeholder="Masukan nama" required>
            </div>
            <div class="form-group">
                <label for="password">Email :</label>
                <i class='bx bxs-envelope' ></i>
                <input type="email" name="email" placeholder="Masukan email" required>
            </div>
            <div class="form-group">
                <label for="password">Password :</label>
                <i class='bx bxs-lock-alt'></i>
                <input type="password" name="password" placeholder="Masukan password" required>
            </div>
            <div class="form-group">
                <label for="password">Tanggal Lahir :</label>
                <input type="date" name="birthdate" placeholder="Masukan tanggal lahir" required>
            </div>
            <div class="form-group">
                <label for="password">No Telepon :</label>
                <i class='bx bxs-phone'></i>
                <input type="number" name="pnum" placeholder="Masukan no telepon" required>
            </div>
            <div class="form-group">
                <label for="password">Alamat :</label>
                <i class='bx bxs-home'></i>
                <input type="text" name="address" placeholder="Masukan alamat" required>
            </div>
            <button type="submit" class="login-button">Register</button>
            <p>Sudah Punya Akun?<a href="login.php"> Login</a></p>
        </form>
    </div>
</body>
</html>
