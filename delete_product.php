<?php
if (!isset($_GET['game_id'])) {
    die("game_id tidak ditemukan.");
}

$game_id = $_GET['game_id'];

// Baca data dari products.json
$products = json_decode(file_get_contents("products.json"), true);

// Validasi
if (!is_array($products)) {
    die("Data produk tidak valid.");
}

// Filter: hanya simpan produk yang game_id-nya **tidak sama**
$filtered = array_filter($products, function($item) use ($game_id) {
    return $item['game_id'] !== $game_id;
});

// Simpan ulang ke file
file_put_contents("products.json", json_encode(array_values($filtered), JSON_PRETTY_PRINT));

// Redirect atau tampilkan pesan sukses
header("Location: admin.php?delete=success");
exit;
?>