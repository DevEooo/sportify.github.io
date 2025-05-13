<?php
require_once "database.php";

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // PENTING: pakai 'id_plan' sesuai database
  $query = "SELECT * FROM membership_plans WHERE id_plan = $id";
  $result = mysqli_query($conn, $query);

  if ($row = mysqli_fetch_assoc($result)) {
    $plan = $row['plan_name'];
    $price = $row['price'];
  } else {
    echo "Paket tidak ditemukan.";
    exit;
  }
} else {
  echo "ID paket tidak tersedia.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/payment.css">
  <title>Pembayaran untuk <?= htmlspecialchars($plan) ?></title>
</head>

<body>
  <header>
    <h1 class="logo">Sportify</h1>
    <a href="premium.php">
      <button class="premium-btn">kembali</button>
    </a>
  </header>

  <main>
    <div class="payment-header">
      <h1>Lengkapi Pembayaran</h1>
      <p>Isi data diri dan pilih metode pembayaran untuk menyelesaikan langganan premium Anda</p>
    </div>

    <div class="selected-plan">
      <h2><?= htmlspecialchars($plan) ?></h2>
      <p class="price">Rp<?= number_format($price, 0, ',', '.') ?></p>
    </div>

    <form action="act_payment.php" method="POST" class="payment-form">
      <input type="hidden" name="plan" value="<?= htmlspecialchars($plan) ?>">
      <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="email@contoh.com" required>
      </div>

      <div class="form-group">
        <label for="telepon">Nomor Telepon</label>
        <input type="tel" id="telepon" name="telepon" placeholder="0812-3456-7890" required>
      </div>

      <div class="form-group">
        <label>Metode Pembayaran</label>
        <div class="payment-methods">
          <label class="payment-method">
            <input type="radio" name="payment_method" value="credit_card" checked>
            <div class="method-content">
              <p>Kartu Kredit/Debit</p>
            </div>
          </label>

          <label class="payment-method">
            <input type="radio" name="payment_method" value="gopay">
            <div class="method-content">
              <p>Gopay</p>
            </div>
          </label>

          <label class="payment-method">
            <input type="radio" name="payment_method" value="ovo">
            <div class="method-content">
              <p>OVO</p>
            </div>
          </label>
        </div>
      </div>

      <button type="button" class="submit-btn" onclick="showConfirmation()">LANGGANAN SEKARANG</button>
    </form>
  </main>

  <footer>
    <p>&copy; 2025 Sportify. All rights reserved.</p>
  </footer>

  <!-- Modal for Confirmation -->
  <div id="confirmationModal" class="modal" style="display:none;">
    <div class="modal-content">
      <h2>Konfirmasi Langganan</h2>
      <p><strong>Paket:</strong> <span id="confirmPlan"></span></p>
      <p><strong>Harga:</strong> <span id="confirmPrice"></span></p>
      <p><strong>Email:</strong> <span id="confirmEmail"></span></p>
      <p><strong>Telepon:</strong> <span id="confirmTelepon"></span></p>
      <p><strong>Metode Pembayaran:</strong> <span id="confirmPayment"></span></p>
      <div class="modal-actions">
        <button onclick="submitForm()">Konfirmasi</button>
        <button onclick="closeModal()">Batal</button>
      </div>
    </div>
  </div>

  <!-- Modal for Success Notification -->
  <div id="successModal" class="modal" style="display:none;">
    <div class="modal-content">
      <h2>Pembayaran Berhasil!</h2>
      <p>Terima kasih telah berlangganan. Anda akan diarahkan ke halaman utama dalam beberapa detik...</p>
    </div>
  </div>


  <script>
    // Function to display the confirmation modal with the user inputs
    function showConfirmation() {
      const plan = document.querySelector('input[name="plan"]').value;
      const price = document.querySelector('input[name="price"]').value;
      const email = document.getElementById('email').value;
      const telepon = document.getElementById('telepon').value;
      const paymentMethod = document.querySelector('input[name="payment_method"]:checked').parentElement.textContent.trim();

      // Check if email and telepon are filled in
      if (!email || !telepon) {
        alert("Harap lengkapi email dan telepon.");
        return;
      }

      // Set the values in the modal
      document.getElementById('confirmPlan').textContent = plan;
      document.getElementById('confirmPrice').textContent = "Rp" + Number(price).toLocaleString('id-ID');
      document.getElementById('confirmEmail').textContent = email;
      document.getElementById('confirmTelepon').textContent = telepon;
      document.getElementById('confirmPayment').textContent = paymentMethod;

      // Show the modal
      document.getElementById('confirmationModal').style.display = 'flex';
    }

    // Function to close the modal
    function closeModal() {
      document.getElementById('confirmationModal').style.display = 'none';
    }

    // Function to submit the form
    function submitForm() {
      closeModal();

      // Tampilkan modal sukses
      document.getElementById('successModal').style.display = 'flex';

      // Tunggu 3 detik sebelum redirect
      setTimeout(() => {
        // Jika kamu ingin tetap mengirim data ke server sebelum redirect,
        // kamu bisa mengirim form pakai AJAX (opsional), atau langsung redirect.
        window.location.href = "beranda_user.php"; // Ganti dengan halaman utama kamu
      }, 3000);
    }
  </script>

  <!-- CSS for Modal -->
  <style>
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: white;
      color: black;
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      text-align: center;
    }

    .modal-actions button {
      margin: 10px;
    }
  </style>

</body>

</html>