<?php
$settings = json_decode(file_get_contents("settings.json"), true);
$settings['wa_sender'] = $_POST['wa_sender'];

if (!empty($_FILES['sliders']['name'][0])) {
  foreach ($_FILES['sliders']['tmp_name'] as $i => $tmp) {
    $fileName = $_FILES['sliders']['name'][$i];
    move_uploaded_file($tmp, "img/" . $fileName);
    $settings['sliders'][] = $fileName;
  }
}

file_put_contents("settings.json", json_encode($settings, JSON_PRETTY_PRINT));
header("Location: admin.php");