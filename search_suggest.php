<?php
require_once "database.php";

if (!isset($_GET['q'])) {
    echo json_encode([]);
    exit;
}

$q = trim($_GET['q']);
$safe_q = mysqli_real_escape_string($conn, $q);

$sql = "SELECT title, artist FROM songs WHERE title LIKE '%$safe_q%' OR artist LIKE '%$safe_q%' LIMIT 5";
$result = mysqli_query($conn, $sql);

$suggestions = [];

while ($row = mysqli_fetch_assoc($result)) {
    $suggestions[] = [
        'title' => $row['title'],
        'artist' => $row['artist']
    ];
}

header('Content-Type: application/json');
echo json_encode($suggestions);
