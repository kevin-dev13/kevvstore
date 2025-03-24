<?php
$products = json_decode(file_get_contents("products.json"), true);

$gameId = $_POST['game_id'];
$name = $_POST['name'];
$price = (int)$_POST['price'];

// Generate ID unik otomatis
$lastId = 1;
foreach ($products as $p) {
  if ($p['game_id'] === $gameId) {
    $num = (int) str_replace($gameId . "-", "", $p['id_produk']);
    if ($num >= $lastId) $lastId = $num + 1;
  }
}
$idProduk = $gameId . "-" . $lastId;

$products[] = [
  "id_produk" => $idProduk,
  "game_id" => $gameId,
  "name" => $name,
  "price" => $price
];

file_put_contents("products.json", json_encode($products, JSON_PRETTY_PRINT));
header("Location: admin.php");