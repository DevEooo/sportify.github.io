<?php
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
  $id_membership = intval($_POST['id_plan']);
  $price = intval($_POST['price']);
  $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

  // Format dan data tambahan
  $payment_date = date("Y-m-d H:i:s");
  $payment_status = "Pending"; // default
  $id_transaction = rand(100000, 999999); // bisa pakai sistem lebih baik
  $created_at = $payment_date;
  $updated_at = $payment_date;

  $query = "INSERT INTO payment 
            (id_membership, email, phone_num, total, payment_date, payment_method, payment_status, id_transaction, created_at, updated_at)
            VALUES 
            ($id_membership, '$email', '$telepon', $price, '$payment_date', '$payment_method', '$payment_status', $id_transaction, '$created_at', '$updated_at')";

  if (mysqli_query($conn, $query)) {
    echo "<h2>Pembayaran berhasil disimpan!</h2>";
    echo "<p>ID Transaksi Anda: <strong>$id_transaction</strong></p>";
    echo "<p>Status: <strong>$payment_status</strong></p>";
    echo "<a href='beranda_user.php'>Kembali ke Beranda</a>";
  } else {
    echo "Terjadi kesalahan: " . mysqli_error($conn);
  }
} else {
  echo "Metode tidak valid.";
}
?>
