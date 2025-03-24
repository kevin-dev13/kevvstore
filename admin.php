<?php
$games = json_decode(file_get_contents("games.json"), true);
$settings = json_decode(file_get_contents("settings.json"), true);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .sidebar {
      height: 100vh;
      background: #1a1a1a;
    }
    .nav-link {
      color: #ffffff;
      transition: all 0.3s;
    }
    .nav-link:hover {
      background: #2d2d2d;
      color: #ffffff;
    }
    .card {
      background: #2d2d2d;
      border: 1px solid #3d3d3d;
    }
    .form-control {
      background: #1a1a1a;
      border: 1px solid #3d3d3d;
      color: white;
      background-color: white;;
    }
    body, .card-title, .form-label {
      color: white !important;
    }
  </style>
</head>
<body class="bg-dark">
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 sidebar p-0">
      <div class="p-3">
        <h4 class="mb-4"><i class="fas fa-user-shield me-2"></i> Admin Panel</h4>
        <nav class="nav flex-column">
          <a class="nav-link active" href="#games"><i class="fas fa-gamepad me-2"></i> Manajemen Game</a>
          <a class="nav-link" href="#products"><i class="fas fa-shopping-cart me-2"></i> Manajemen Produk</a>
          <a class="nav-link" href="#settings"><i class="fas fa-cog me-2"></i> Pengaturan</a>
        </nav>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 col-lg-10 ms-auto p-4">
      <!-- Header -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h3>
        <a href="#" class="btn btn-outline-light"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>

      <!-- Tambah Game Section -->
      <div class="card mb-4" id="games">
        <div class="card-header bg-primary">
          <h5 class="card-title mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Game Baru</h5>
        </div>
        <div class="card-body">
          <form action="save_game.php" method="POST" enctype="multipart/form-data">
            <div class="row g-3">
              <div class="col-md-6">
                <input name="id" class="form-control mb-2" placeholder="ID Game (cth: ml)" required>
              </div>
              <div class="col-md-6">
                <input name="name" class="form-control mb-2" placeholder="Nama Game" required>
              </div>
              <div class="col-12">
                <input type="file" name="image" class="form-control mb-2" required>
              </div>
              <div class="col-md-6">
                <input name="wa" class="form-control mb-2" placeholder="WA Khusus Game (optional)">
              </div>
              <div class="col-md-6">
                <div class="form-check form-switch mt-2">
                  <input class="form-check-input" type="checkbox" name="trending" value="1">
                  <label class="form-check-label">Trending</label>
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-success"><i class="fas fa-save me-2"></i>Simpan Game</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Tambah Produk Section -->
      <div class="card mb-4" id="products">
        <div class="card-header bg-warning">
          <h5 class="card-title mb-0"><i class="fas fa-box-open me-2"></i>Tambah Produk Baru</h5>
        </div>
        <div class="card-body">
          <form action="save_product.php" method="POST">
            <div class="row g-3">
              <div class="col-md-6">
                <select name="game_id" class="form-select mb-2">
                  <?php foreach ($games as $g): ?>
                    <option value="<?= $g['id'] ?>"><?= $g['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6">
                <input name="name" class="form-control mb-2" placeholder="Nama Produk" required>
              </div>
              <div class="col-md-6">
                <input name="price" type="number" class="form-control mb-2" placeholder="Harga" required>
              </div>
              <div class="col-12">
                <button class="btn btn-warning"><i class="fas fa-save me-2"></i>Simpan Produk</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Pengaturan Section -->
      <div class="card mb-4" id="settings">
        <div class="card-header bg-info">
          <h5 class="card-title mb-0"><i class="fas fa-cogs me-2"></i>Pengaturan Sistem</h5>
        </div>
        <div class="card-body">
          <form action="save_settings.php" method="POST">
            <div class="row g-3">
              <div class="col-md-6">
                <input name="wa_sender" class="form-control mb-2" 
                       placeholder="Nomor WhatsApp Admin" 
                       value="<?= $settings['wa_sender'] ?? '' ?>" 
                       required>
              </div>
              <div class="col-12">
                <button class="btn btn-info"><i class="fas fa-save me-2"></i>Simpan Pengaturan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>