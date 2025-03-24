<?php
$games = json_decode(file_get_contents("games.json"), true);
$settings = json_decode(file_get_contents("settings.json"), true);
$sliders = $settings['sliders'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Top Up Game - Kevv Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --bg-primary: #1a1a2e;
      --bg-secondary: #2a2a4a;
      --accent-color: #6366f1;
    }
    
    body { 
      background-color: var(--bg-primary); 
      color: #ffffff !important;
      font-family: 'Inter', sans-serif;
    }
    
    .navbar-brand {
      font-weight: 700;
      letter-spacing: 0.5px;
      color: #ffffff !important;
    }
    
    .card {
      background: var(--bg-secondary);
      border: none;
      border-radius: 12px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
      color: #ffffff;
    }
    
    .carousel-item {
      background-color: var(--bg-secondary);
      min-height: 300px;
    }
    
    .carousel-img {
      width: auto;
      max-height: 300px;
      margin: 0 auto;
      object-fit: contain;
    }
    
    .img-container {
      position: relative;
      width: 100%;
      padding-top: 100%;
      overflow: hidden;
    }
    
    .card-img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: contain;
      padding: 15%;
    }
    
    .marquee {
      background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 100%);
      padding: 12px 0;
      font-size: 0.9rem;
      color: #ffffff;
    }
    
    .trending-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background: #ef4444;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.75rem;
      color: #ffffff;
    }
    
    footer {
      border-top: 1px solid rgba(255,255,255,0.1);
      background: var(--bg-secondary);
      color: #ffffff;
    }
    
    .section-title {
      font-weight: 600;
      margin: 2rem 0 1.5rem;
      padding-bottom: 0.5rem;
      border-bottom: 2px solid var(--accent-color);
      position: relative;
      color: #ffffff;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100px;
      height: 2px;
      background: rgba(99, 102, 241, 0.4);
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      filter: invert(1);
    }
  </style>
</head>
<body>
<nav class="navbar navbar-dark px-3 py-3">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="img/logo.png" alt="Logo" height="40">
    </a>
  </div>
</nav>

  <div class="container">
    <!-- Marquee -->
    <div class="marquee mb-4">
      <div class="container text-center fw-medium">
        Selamat datang di KEVV STORE • Top Up Game Murah, Aman, dan Cepat 
      </div>
    </div>

    <!-- Trending -->
    <h3 class="section-title">Trending Game</h3>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
      <?php foreach ($games as $game): if ($game['trending']): ?>
        <div class="col">
          <a href="order.php?game=<?= $game['id'] ?>" class="text-decoration-none">
            <div class="card h-100 position-relative">
              <div class="img-container">
                <img src="img/<?= $game['image'] ?>" class="card-img">
              </div>
              <div class="card-body text-center pb-3">
                <h6 class="card-title mb-0 fw-semibold"><?= $game['name'] ?></h6>
              </div>
            </div>
          </a>
        </div>
      <?php endif; endforeach; ?>
    </div>

    <!-- All Game -->
    <h3 class="section-title">Semua Game</h3>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 mb-5">
      <?php foreach ($games as $game): ?>
        <div class="col">
          <a href="order.php?game=<?= $game['id'] ?>" class="text-decoration-none">
            <div class="card h-100">
              <div class="img-container">
                <img src="img/<?= $game['image'] ?>" class="card-img">
              </div>
              <div class="card-body text-center pb-3">
                <h6 class="card-title mb-0 fw-semibold"><?= $game['name'] ?></h6>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <footer class="py-4 mt-5">
    <div class="container text-center">
      <small>© <?= date('Y') ?> Kevv Store • Powered by Rasyel Dev</small>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>