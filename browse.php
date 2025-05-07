<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Browse Items | Sai Pali</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #0b1a33;
      color: #f1f1f1;
    }

    .hero-section {
      height: 100vh;
      background: linear-gradient(to right, rgba(11, 26, 51, 0.85), rgba(6, 19, 43, 0.85)),
                  url('assets/images/bg3.jpg') center center/cover no-repeat;
      padding: 60px 15px;
      text-align: center;
      position: relative;
    }

    .glass-box {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      max-width: 600px;
      margin: auto;
    }

    .scroll-btn {
      width: 60px;
      height: 60px;
      margin-top: 20px;
      border: 2px solid white;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      transition: all 0.3s ease;
    }

    .scroll-btn:hover {
      background-color: white;
      color: #0b1a33;
      transform: scale(1.1);
    }

    html {
      scroll-behavior: smooth;
    }

    .section-template {
      background: linear-gradient(rgba(11, 26, 51, 0.95), rgba(11, 26, 51, 0.95)),
                  url('assets/images/lost.jpg') no-repeat center center/cover;
      padding: 60px 20px;
      border-radius: 10px;
      margin-top: 60px;
      color: #f1f1f1;
    }
    .section-template1 {
      background: linear-gradient(rgba(11, 26, 51, 0.95), rgba(11, 26, 51, 0.95)),
                  url('assets/images/found2.jpg') no-repeat center center/cover;
      padding: 60px 20px;
      border-radius: 10px;
      margin-top: 60px;
      color: #f1f1f1;
    }

    .secheader {
      font-size: 2rem;
      font-weight: bold;
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 20px;
      color: #ffd700;
    }

    .card {
      width: 250px;  
      height: 250px;
      background-color: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      overflow: hidden;
      backdrop-filter: blur(4px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
      text-align: center;
      /* padding: 20px; */

    }

    .card:hover {
      transform: scale(1.03);
    }

    .card-img-circle {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto 15px auto;
      border: 4px solid #ccc;
      box-shadow: 0 0 8px rgba(255,255,255,0.2);
    }

    .card-title {
      font-size: 1.2rem;
      font-weight: bold;
    }

    .card-text {
      font-size: 0.95rem;
      color: #cccccc;
    }

    .btn-outline-primary,
    .btn-outline-success {
      border-radius: 25px;
    }

    @media (max-width: 768px) {
      .card-img-circle {
        width: 110px;
        height: 110px;
      }
    }
  </style>
</head>
<body>
<?php include("includes/header.php"); ?>

<section class="hero-section d-flex align-items-center justify-content-center text-light">
  <div class="glass-box text-center p-5 rounded-4 shadow-lg">
    <h1 class="display-4 fw-bold mb-3">Welcome to Sai Pali Lost & Found</h1>
    <p class="lead mb-4">Search, report, and recover lost or found items quickly and easily.</p>
    <a href="#browse-section" class="scroll-btn btn btn-outline-light rounded-circle shadow">
      <i class="bi bi-chevron-double-down fs-3"></i>
    </a>
  </div>
</section>

<main id="browse-section" class="container mt-5">

  <section class="section-template">
    <h2 class="secheader">Lost Items</h2>
    <p class="text-center text-light mb-4">Items reported lost recently.</p>
    <div class="row g-4">
      <?php
      include 'config.php';
      $query = "SELECT * FROM items WHERE status = 'Lost' ORDER BY date_lost_found DESC";
      $result = mysqli_query($conn, $query);
      if ($result && mysqli_num_rows($result) > 0) {
        while ($item = mysqli_fetch_assoc($result)) {
          $image = !empty($item['image_path']) ? htmlspecialchars($item['image_path']) : 'assets/default-placeholder.png';
          echo '
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100">
              <img src="' . $image . '" class="card-img-circle" alt="Lost Item">
              <h5 class="card-title">' . htmlspecialchars($item['name']) . '</h5>
              <p class="card-text">' . htmlspecialchars($item['description']) . '</p>
              <a href="item-details.php?id=' . $item['id'] . '" class="btn btn-outline-primary mt-2">View Details</a>
            </div>
          </div>';
        }
      } else {
        echo '<p class="text-muted">No lost items found.</p>';
      }
      ?>
    </div>
  </section>

  <section class="section-template1">
    <h2 class="secheader">Found Items</h2>
    <p class="text-center text-light mb-4">Items that have been found and reported.</p>
    <div class="row g-4">
      <?php
      $query = "SELECT * FROM items WHERE status = 'Found' ORDER BY date_lost_found DESC";
      $result = mysqli_query($conn, $query);
      if ($result && mysqli_num_rows($result) > 0) {
        while ($item = mysqli_fetch_assoc($result)) {
          $image = !empty($item['image_path']) ? htmlspecialchars($item['image_path']) : 'assets/default-placeholder.png';
          echo '
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100">
              <img src="' . $image . '" class="card-img-circle" alt="Found Item">
              <h5 class="card-title">' . htmlspecialchars($item['name']) . '</h5>
              <p class="card-text">' . htmlspecialchars($item['description']) . '</p>
              <a href="item-details.php?id=' . $item['id'] . '" class="btn btn-outline-success mt-2">View Details</a>
            </div>
          </div>';
        }
      } else {
        echo '<p class="text-muted">No found items available.</p>';
      }
      $conn->close();
      ?>
    </div>
  </section>
</main>

<?php include("includes/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
