<?php
    require_once "../database.php"; 

    $email = $_POST['email'];   
    $password = $_POST['password']; 

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && $password == $row['password']){
        $_SESSION['login'] = true; 
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name']; 

        header('location:../beranda_user.php');
        exit();
    } else {
        echo "<script>
                alert('Password Atau Email Yang Anda Masukkan Salah!!!');
                window.location.href = '../login.php';
            </script>";
    }