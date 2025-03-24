<?php
$games = json_decode(file_get_contents("games.json"), true);

$id = $_POST['id'];
$name = $_POST['name'];
$wa = $_POST['wa'];
$trending = isset($_POST['trending']);
$imageName = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "img/" . $imageName);

$games[] = [
  "id" => $id,
  "name" => $name,
  "image" => $imageName,
  "wa" => $wa,
  "trending" => $trending
];

file_put_contents("games.json", json_encode($games, JSON_PRETTY_PRINT));
header("Location: admin.php");