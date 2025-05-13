<?php

require_once "database.php";

if(!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}

// Prevent browser caching of this page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Ambil 5 album untuk ditampilkan
$query_album = "SELECT * FROM albums LIMIT 5";
$result_album = mysqli_query($conn, $query_album);

// Ambil 4 lagu rekomendasi
$query_songs = "SELECT * FROM songs LIMIT 4";
$result_songs = mysqli_query($conn, $query_songs);

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="css/beranda_userw.css">
  <title>Sportify</title>
</head>
<body>
<header>
  <div class="header-left">
    <img src="img/logo_sportify.png" alt="Sportify Logo" class="logo">
    <h1 class="sp">Sportify</h1>
  </div>
  
  <div class="home-btn">
    <a href="beranda_user.php"><i class="bi bi-house-door"></i></i></a>
  </div>

  <div class="search-container" style="position: relative;">
  <form action="search.php" method="get" autocomplete="off">
    <i class='bx bx-search'></i>
    <input type="text" name="query" id="search-input" placeholder="Mau Setel Apa Hari Ini?" required />
    <div id="suggestions" style="position: absolute; top: 40px; left: 0; right: 0; background: #fff; z-index: 1000; display: none; box-shadow: 0 2px 8px rgba(0,0,0,0.2); max-height: 200px; overflow-y: auto;"></div>
  </form>
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
 
  <!-- Rest of your HTML content remains the same -->
  <main>
    <!-- Album Section -->
    <section class="album-section">
      <h2>Album Populer</h2>
      <div class="albums">
        <?php while($album = mysqli_fetch_assoc($result_album)): ?>
          <a href="album.php?id=<?= $album['id_album'] ?>" class="album-card">
            <div class="album-cover">
              <img src="<?= $album['cover_url']; ?>" alt="Album Cover">
            </div>
            <h3 class="album-title"><?= $album['title']; ?></h3>
            <p class="album-artist"><?= $album['artist']; ?></p>
          </a>
        <?php endwhile; ?>
      </div>
    </section>

    <!-- Rekomendasi Lagu Section -->
    <section class="recommendation-section">
      <h2>Rekomendasi Sound Hari Ini</h2>
      <div class="song-list">
        <?php while($song = mysqli_fetch_assoc($result_songs)): ?>
          <div class="song-card">
            <div class="song-info">
              <p class="song-title"><?= $song['title']; ?></p>
              <p class="artist"><?= $song['artist']; ?> • <?= $song['album']; ?></p>
            </div>
            <audio controls>
              <source src="<?= $song['file_url']; ?>" type="audio/mpeg">
              Browser kamu tidak mendukung pemutar audio.
            </audio>
          </div>
        <?php endwhile; ?>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Sportify. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

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