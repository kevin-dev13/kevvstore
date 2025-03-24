<?php
$gameId = $_GET['game'] ?? '';
$games = json_decode(file_get_contents("games.json"), true);
$products = json_decode(file_get_contents("products.json"), true);
$settings = json_decode(file_get_contents("settings.json"), true);

$game = array_filter($games, fn($g) => $g['id'] === $gameId);
$game = array_values($game)[0] ?? null;

if (!$game) {
  echo "Game tidak ditemukan.";
  exit;
}

$wa = !empty($game['wa']) ? $game['wa'] : $settings['wa_sender'];
$gameName = $game['name'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <title>Order - <?= $gameName ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #1e1e2f; color: white; }
    .card { background-color: #2c2c3e; border: none; color: white; }
    .navbar, footer { background-color: #19192b; }
    input, select { background-color: #2c2c3e !important; color: white !important; border: 1px solid #444; }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark px-3">
    <a href="index.php" class="navbar-brand">← Back</a>
    <span class="navbar-text"><?= $gameName ?></span>
  </nav>

  <div class="container mt-4">
    <h4>Formulir Pembelian</h4>
    <form id="orderForm">
      <div class="mb-3">
        <label for="idplayer" class="form-label">ID Game / ID Player</label>
        <input type="text" class="form-control" id="idplayer" required placeholder="Masukkan ID Game kamu">
      </div>
      <div class="mb-3">
        <label for="product" class="form-label">Pilih Produk</label>
        <select id="product" class="form-select" required>
          <option value="">-- Pilih Produk --</option>
          <?php foreach ($products as $p): if ($p['game_id'] == $gameId): ?>
            <option value="<?= htmlspecialchars(json_encode($p)) ?>">
              <?= $p['name'] ?> - Rp <?= number_format($p['price'], 0, ',', '.') ?>
            </option>
          <?php endif; endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-success w-100">Beli via WhatsApp</button>
    </form>
  </div>

  <footer class="text-center py-3 mt-4">
    <small>© <?= date('Y') ?> TopUp Game</small>
  </footer>

  <script>
    document.getElementById("orderForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const id = document.getElementById("idplayer").value.trim();
      const productData = JSON.parse(document.getElementById("product").value);
      const message = `Halo admin, saya ingin top up game *<?= $gameName ?>*\n\nProduk: ${productData.name}\nHarga: Rp ${productData.price.toLocaleString()}\nID Game: ${id}\nID Produk: ${productData.id_produk}`;
      const wa = "<?= $wa ?>";
      window.open(`https://wa.me/${wa}?text=${encodeURIComponent(message)}`, '_blank');
    });
  </script>
</body>
</html>