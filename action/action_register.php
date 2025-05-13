<?php
    require_once "../database.php";

    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    $pnum = $_POST['pnum'];
    $address = $_POST['address'];
 
    $query = "SELECT * FROM users WHERE name = '$name' OR email = '$email'";
    $hasil = mysqli_query($conn, $query);

    if (mysqli_num_rows($hasil) > 0){
        echo "<script>alert('Nama atau Email sudah digunakan!!!');
                window.location.href = '../register.php';
                </script>";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO users (name, email, password, birthdate, phone_num, address) 
            VALUES ('$name', '$email', '$password', '$birthdate', '$pnum', '$address')");
        if($insert){
            echo "<script>alert('Registrasi Berhasil!!!');
                    window.location.href = '../login.php';
                    </script>";
        } else {
            echo "<script>alert('Registrasi Gagal!!!');
                    window.location.href = '../register.php';
                    </script>";
        } exit();
    }