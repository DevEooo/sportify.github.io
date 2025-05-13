<?php
require_once "database.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/premiumt.css">
  <title>Berlangganan Premium - Sportify</title>
</head>
<body>
  <header>
    <h1 class="logo">Sportify</h1>
    <a href="beranda_user.php">
    <button class="premium-btn" >kembali</button>
    </a>
  </header>

  <main>
    <div class="premium-header">
      <h1>Upgrade ke Sportify Premium</h1>
      <p>Nikmati pengalaman mendengarkan musik tanpa batas dengan bebas iklan, kualitas audio tinggi, dan lebih hemat</p>
    </div>

    <?php
    $query = "SELECT * FROM membership_plans";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)){ 

    ?>

    <div class="cards">
      <div class="card">
      <div class="discount-badge">30%</div>
        <h3><?= $row['plan_name'] ?></h3>
        <h4><?= $row['duration'] ?></h4>
        <p class="price">Rp<?= number_format($row['price'], 0, ',', '.') ?></p>
        <ul>
          <li><?= $row['description_plan'] ?></li>
          <li><?= $row['description_plan'] ?></li>
        </ul>
        <a href="payment.php?id=<?= $row['id_plan']?>">
        <button class="select-btn">PILIH PAKET</button>
        </a>
    </div>
      <?php } ?>
  </main>

  <footer>
    <p>&copy; 2025 Sportify. All rights reserved.</p>
  </footer>
</body>
</html>