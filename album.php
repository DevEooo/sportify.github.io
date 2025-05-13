<?php

require_once 'database.php';

if(!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}

// Prevent browser caching of this page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Ambil ID album dari URL
$album_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Cek apakah album ada
$query_album = "SELECT * FROM albums WHERE id_album = $album_id";
$result_album = mysqli_query($conn, $query_album);
$album_info = mysqli_fetch_assoc($result_album);

// Ambil semua lagu dari album ini
$query_songs = "SELECT * FROM songs WHERE album_id = $album_id";
$result_songs = mysqli_query($conn, $query_songs);

// Ambil lagu pertama (buat ditampilkan besar di header)
$first_song = mysqli_fetch_assoc($result_songs);

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/albumi.css">
  <title><?= $album_info ? $album_info['title'] : 'Album Tidak Ditemukan' ?> | Sportify</title>
</head>
<body>
<header>
  <div class="header-left">
      <img src="img/logo_sportify.png" alt="Sportify Logo" class="logo">
    <a href="beranda_user.php">
      <h1 class="sp">Sportify</h1>
    </a>
  </div>
  
  <div class="search-container">
    <i class='bx bx-search'></i>
    <input type="text" placeholder="Mau Setel Apa Hari Ini?" />
  </div>
  
  <div class="header-right">
    <div class="user-dropdown">
      <button class="user-btn">
        <i class='bx bx-user-circle user-icon'></i>
        <?= htmlspecialchars($_SESSION['name']) ?>
        <i class="bx bx-chevron-down dropdown-icon"></i>
      </button>
      <div class="dropdown-content">
      <div class="user-info">
            <i class='bx bx-user-circle'></i>
            <div>
              <strong><?= htmlspecialchars($_SESSION['name']) ?></strong>
              <small><?= htmlspecialchars($_SESSION['email']) ?></small>
            </div>
          </div>
          <a href="logout.php" class="dropdown-item">
            <i class='bx bx-log-out'></i> Logout
          </a>
        </div>
      </div>
    </div>
    <a href="premium.php">
      <button class="premium-btn">Jelajahi Premium</button>
    </a>
  </div>
</header>

  <?php if ($album_info): ?>
  <div class="album-header">
    <div class="album-cover-large">
      <img src="<?= $album_info['cover_url'] ?>" alt="Album Cover">
    </div>
    <div class="album-info">
      <p class="album-type"><?= $first_song['genre'] ?? 'Tidak diketahui' ?></p>
      <h1 class="album-title-large"><?= $album_info['title'] ?></h1>
      <p class="album-description">
        Album oleh <strong><?= $album_info['artist'] ?></strong>.
        Dirilis tahun <?= $album_info['release_year'] ?? '2025' ?>. 
        Album ini berisi lagu-lagu terbaik dari artis ini.
      </p>
    </div>
  </div>

  <main>
    <div class="song-list">
      <?php
        $no = 1;

        // Tampilkan lagu pertama
        if ($first_song):
      ?>
        <div class="song-item">
          <div class="song-number"><?= $no++ ?></div>
          <div class="song-info">
            <p class="song-title"><?= $first_song['title'] ?></p>
            <p class="artist"><?= $first_song['artist'] ?></p>
          </div>
          <div class="song-actions">
            <audio controls>
              <source src="<?= $first_song['file_url'] ?>" type="audio/mpeg">
              Browser kamu tidak mendukung pemutar audio.
            </audio>
          </div>
        </div>
      <?php endif; ?>

      <?php while ($song = mysqli_fetch_assoc($result_songs)): ?>
        <div class="song-item">
          <div class="song-number"><?= $no++ ?></div>
          <div class="song-info">
            <p class="song-title"><?= $song['title'] ?></p>
            <p class="artist"><?= $song['artist'] ?></p>
          </div>
          <div class="song-actions">
            <audio controls>
              <source src="<?= $song['file_url'] ?>" type="audio/mpeg">
              Browser kamu tidak mendukung pemutar audio.
            </audio>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </main>
  <?php else: ?>
    <main>
      <p class="no-songs">Album tidak ditemukan atau tidak tersedia.</p>
    </main>
  <?php endif; ?>

  <footer>
    <p>&copy; 2025 Sportify. All rights reserved.</p>
  </footer>

  <script>

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }    

    // Toggle dropdown menu
    document.querySelector('.user-btn').addEventListener('click', function() {
      this.querySelector('.dropdown-icon').classList.toggle('rotate');
      document.querySelector('.dropdown-content').classList.toggle('show');
    });

    // Close dropdown when clicking outside
    window.addEventListener('click', function(e) {
      if (!e.target.matches('.user-btn') && !e.target.closest('.user-btn')) {
        const dropdowns = document.querySelectorAll('.dropdown-content');
        dropdowns.forEach(dropdown => {
          if (dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
            document.querySelector('.dropdown-icon').classList.remove('rotate');
          }
        });
      }
    });
  </script>
</body>
</html>
