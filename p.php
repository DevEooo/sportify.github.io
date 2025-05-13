<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Pencarian - Sportify</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    :root {
      --primary: #e5de00;
      --dark: #121212;
      --light-dark: #181818;
      --lighter-dark: #282828;
      --light-gray: #b3b3b3;
      --white: #ffffff;
      --black: #000000;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      background-color: var(--dark);
      color: var(--white);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px 40px;
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(10px);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .logo {
      font-size: 28px;
      font-weight: 700;
      color: var(--primary);
      text-decoration: none;
    }

    .search-container {
      flex-grow: 1;
      margin: 0 30px;
      max-width: 600px;
      position: relative;
    }

    .search-container i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--light-gray);
    }

    header input {
      width: 100%;
      padding: 10px 15px 10px 40px;
      border-radius: 20px;
      border: none;
      background-color: var(--lighter-dark);
      color: var(--white);
      font-size: 14px;
    }

    .user-menu {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: var(--primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: var(--black);
    }

    main {
      flex: 1;
      padding: 20px 40px;
    }

    .search-results {
      margin-top: 20px;
    }

    .section-title {
      color: var(--primary);
      font-size: 24px;
      margin-bottom: 20px;
    }

    .song-list {
      display: grid;
      grid-template-columns: 1fr;
      gap: 10px;
    }

    .song-item {
      display: flex;
      align-items: center;
      padding: 10px;
      background-color: var(--lighter-dark);
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .song-item:hover {
      background-color: #333;
    }

    .song-number {
      width: 30px;
      text-align: center;
      color: var(--light-gray);
    }

    .song-cover {
      width: 50px;
      height: 50px;
      margin: 0 15px;
      border-radius: 5px;
      overflow: hidden;
    }

    .song-cover img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .song-info {
      flex: 1;
    }

    .song-title {
      font-weight: 600;
      margin-bottom: 5px;
    }

    .song-artist {
      font-size: 13px;
      color: var(--light-gray);
    }

    .song-duration {
      margin: 0 30px;
      color: var(--light-gray);
    }

    .song-actions {
      display: flex;
      gap: 15px;
    }

    .action-btn {
      background: none;
      border: none;
      color: var(--light-gray);
      font-size: 16px;
      cursor: pointer;
      transition: color 0.3s;
    }

    .action-btn:hover {
      color: var(--primary);
    }

    .save-btn.saved {
      color: var(--primary);
    }

    audio {
      width: 100%;
      height: 40px;
      margin-top: 5px;
    }

    audio::-webkit-media-controls-panel {
        background-color: var(--light-gray);
        color: var(--white);
    }

    footer {
      text-align: center;
      padding: 15px;
      background-color: var(--light-dark);
      color: var(--light-gray);
      font-size: 14px;
    }

    @media (max-width: 768px) {
      header {
        padding: 15px 20px;
      }
      
      .search-container {
        margin: 0 15px;
      }
      
      main {
        padding: 15px;
      }
      
      .song-item {
        padding: 8px;
      }
      
      .song-cover {
        width: 40px;
        height: 40px;
        margin: 0 10px;
      }
      
      .song-duration {
        display: none;
      }
      
      .song-actions {
        gap: 10px;
      }
    }
  </style>
</head>
<body>
  <header>
    <a href="beranda_userr.php" class="logo">Sportify</a>
    <div class="search-container">
      <i class="fas fa-search"></i>
      <input type="text" id="search-input" placeholder="Cari lagu, artis, atau album..." value="Ambatukam">
    </div>
    <div class="user-menu">
      <div class="user-avatar">U</div>
    </div>
  </header>

  <main>
    <div class="search-results">
      <h2 class="section-title">Hasil Pencarian untuk "Ambatukam"</h2>
      
      <div class="song-list">
        <!-- Hasil Pencarian Lagu -->
        <div class="song-item">
          <div class="song-number">1</div>
          <div class="song-cover">
            <img src="img/bg2.jpg" alt="Album Cover">
          </div>
          <div class="song-info">
            <div class="song-title">Ambatukam</div>
            <div class="song-artist">Artis 1 • Album 1</div>
            <audio controls>
              <source src="sound/acumalaka_sound_effect.mp3" type="audio/mpeg">
              Browser tidak mendukung pemutar audio.
            </audio>
          </div>
          <div class="song-duration">3:45</div>
          <div class="song-actions">
            <button class="action-btn save-btn" onclick="toggleSave(this)">
              <i class="far fa-heart"></i>
            </button>
            <button class="action-btn">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        
        <div class="song-item">
          <div class="song-number">2</div>
          <div class="song-cover">
            <img src="img/bg2.jpg" alt="Album Cover">
          </div>
          <div class="song-info">
            <div class="song-title">Ambatukam Remix</div>
            <div class="song-artist">Artis 2 • Album 2</div>
            <audio controls>
              <source src="sound/acumalaka_sound_effect.mp3" type="audio/mpeg">
              Browser tidak mendukung pemutar audio.
            </audio>
          </div>
          <div class="song-duration">4:12</div>
          <div class="song-actions">
            <button class="action-btn save-btn" onclick="toggleSave(this)">
              <i class="far fa-heart"></i>
            </button>
            <button class="action-btn">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        
        <div class="song-item">
          <div class="song-number">3</div>
          <div class="song-cover">
            <img src="img/bg2.jpg" alt="Album Cover">
          </div>
          <div class="song-info">
            <div class="song-title">Ambatukam (Live)</div>
            <div class="song-artist">Artis 3 • Album 3</div>
            <audio controls>
              <source src="sound/acumalaka_sound_effect.mp3" type="audio/mpeg">
              Browser tidak mendukung pemutar audio.
            </audio>
          </div>
          <div class="song-duration">5:30</div>
          <div class="song-actions">
            <button class="action-btn save-btn" onclick="toggleSave(this)">
              <i class="far fa-heart"></i>
            </button>
            <button class="action-btn">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Sportify. All rights reserved.</p>
  </footer>

  <script>
    // Fungsi untuk menyimpan lagu
    function toggleSave(button) {
      button.classList.toggle('saved');
      const icon = button.querySelector('i');
      
      if (button.classList.contains('saved')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        // Simpan lagu ke daftar favorit (bisa ditambahkan AJAX ke backend)
        alert('Lagu disimpan ke favorit!');
      } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
        // Hapus lagu dari daftar favorit
        alert('Lagu dihapus dari favorit!');
      }
    }

    // Fungsi pencarian (contoh sederhana)
    document.getElementById('search-input').addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        const query = this.value.trim();
        if (query) {
          // Di sini bisa ditambahkan AJAX untuk pencarian real
          alert('Mencari: ' + query);
        }
      }
    });
  </script>
</body>
</html>