<?php
require_once "database.php";

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian - Sportify</title>
    <link rel="stylesheet" href="css/beranda_userw.css">
</head>

<body>
    <header>
        <!-- Include your existing header code here -->
    </header>

    <main>
        <h2>Hasil Pencarian untuk: <em><?= htmlspecialchars($query) ?></em></h2>

        <div class="song-list">
            <?php
            if ($query !== '') {
                $safe_query = mysqli_real_escape_string($conn, $query);
                $sql = "SELECT * FROM songs WHERE title LIKE '%$safe_query%' OR artist LIKE '%$safe_query%'";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($song = mysqli_fetch_assoc($result)) {
                        echo '<div class="song-card">';
                        echo '<div class="song-info">';
                        echo '<p class="song-title">' . htmlspecialchars($song['title']) . '</p>';
                        echo '<p class="artist">' . htmlspecialchars($song['artist']) . ' • ' . htmlspecialchars($song['album']) . '</p>';
                        echo '</div>';
                        echo '<audio controls><source src="' . htmlspecialchars($song['file_url']) . '" type="audio/mpeg">Browser kamu tidak mendukung pemutar audio.</audio>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Tidak ada hasil yang ditemukan.</p>";
                }
            } else {
                echo "<p>Masukkan kata kunci pencarian.</p>";
            }

            mysqli_close($conn);
            ?>
        </div>
    </main>

    <script>
        const input = document.getElementById('search-input');
        const suggestionsBox = document.getElementById('suggestions');

        input.addEventListener('input', function () {
            const query = this.value;

            if (query.length < 2) {
                suggestionsBox.style.display = 'none';
                return;
            }

            fetch(`search_suggest.php?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        suggestionsBox.innerHTML = data.map(item =>
                            `<div class="suggest-item" style="padding: 8px; cursor: pointer;">
            ${item.title} <small>by ${item.artist}</small>
          </div>`
                        ).join('');
                        suggestionsBox.style.display = 'block';

                        // Click to autofill
                        document.querySelectorAll('.suggest-item').forEach(el => {
                            el.onclick = () => {
                                input.value = el.innerText.split(' by ')[0];
                                suggestionsBox.style.display = 'none';
                                input.form.submit(); // Optional: auto-submit
                            };
                        });
                    } else {
                        suggestionsBox.style.display = 'none';
                    }
                });
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function (e) {
            if (!suggestionsBox.contains(e.target) && e.target !== input) {
                suggestionsBox.style.display = 'none';
            }
        });
    </script>

    <footer>
        <p>&copy; 2025 Sportify. All rights reserved.</p>
    </footer>
</body>

</html>