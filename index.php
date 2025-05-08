<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sai Pali Lost and Found</title>
  <link rel="stylesheet" href="bootstrap-5/css/bootstrap.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #0d1b2a;
      color: #fff;
    }

    .section {
      position: relative;
      padding: 80px 20px;
      background-color: #0d1b2a;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(13, 27, 42, 0.7);
      z-index: 1;
    }

    .section-content {
      position: relative;
      z-index: 2;
      text-align: center;
    }

    .hero {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
    }

    .hero p {
      font-size: 1.25rem;
      margin-bottom: 30px;
    }

    .btn-primary, .cta-btn {
      background-color: #1c77c3;
      border: none;
      padding: 12px 25px;
      border-radius: 5px;
      color: #fff;
      text-decoration: none;
      font-size: 1.1rem;
      margin: 5px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover, .cta-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 15px rgba(28, 119, 195, 0.5);
    }

    .btn-outline-light {
      border: 1px solid #fff;
      color: #fff;
      margin-left: 10px;
    }

    .btn-outline-light:hover {
      background-color: #fff;
      color: #000;
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
      transform: translateY(-5px);
    }

    .card img {
      height: 100px;
      width: 100px;
      object-fit: cover;
      border-radius: 50%;
      margin-top: 15px;
      transition: transform 0.3s ease;
    }

    .card:hover img {
      transform: scale(1.05);
    }

    .card-body {
        padding: 10px;
        text-align: center;
      /* padding: 15px 20px 20px; */
      color: #fff;
    }

    .footer {
      background-color: #0b132b;
      color: #ccc;
      padding: 40px 0;
      text-align: center;
    }

    .footer a {
      color: #ccc;
    }

    .footer a:hover {
      color: #fff;
    }

    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
      }
      .hero p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
<?php include('includes/header.php'); ?>

<!-- HERO SECTION -->
<section class="section hero" style="background-image: url('assets/images/bg3.jpg');" data-aos="fade-in">
  <div class="overlay"></div>
  <div class="section-content">
    <h1>Sai Pali Lost & Found</h1>
    <p>Helping our school community reconnect with lost and found items every day</p> 
    <a href="report-lost.php" class="btn-primary">Report Lost</a>
    <a href="browse.php" class="btn btn-outline-light">Browse Listings</a>
  </div>
</section>

<!-- LOST SOMETHING -->
<section class="section" style="background-image: url('assets/images/lost.jpg');" data-aos="fade-up">
  <div class="overlay"></div>
  <div class="section-content">
    <h2>Lost Something?</h2>
    <p>Report your lost item with a few simple details. We’ll help reconnect the owner with you.</p>
    <a href="report-lost.php" class="cta-btn">Submit Lost Report</a>
  </div>
</section>

<!-- RECENT LOST ITEMS -->
<section class="section" style="background-image: url('assets/images/bg2.jpg');" data-aos="fade-up">
  <div class="overlay"></div>
  <div class="section-content container">
    <h2>Recently Reported Lost Items</h2>
    <div class="row">
      <?php
      include 'config.php';
      $query = "SELECT * FROM items WHERE status = 'Lost' ORDER BY date_lost_found DESC LIMIT 5";
      $result = mysqli_query($conn, $query);
      if ($result && mysqli_num_rows($result) > 0) {
        while ($item = mysqli_fetch_assoc($result)) {
          $image = !empty($item['image_path']) ? htmlspecialchars($item['image_path']) : 'assets/default-placeholder.png';
          echo '<div class="col-md-4 mb-4" data-aos="zoom-in">'
              . '<div class="card">'
              . '<img src="' . $image . '" class="card-img-top mx-auto d-block" alt="Item Image">'
              . '<div class="card-body">'
              . '<h5 class="card-title">' . htmlspecialchars($item['name']) . '</h5>'
              . '<p class="card-text">' . htmlspecialchars($item['description']) . '</p>'
              . '<a href="item-details.php?id=' . $item['id'] . '" class="btn btn-outline-light btn-sm">View</a>'
              . '</div>'
              . '</div>'
              . '</div>';
        }
      } else {
        echo '<p class="text-light">No lost items found.</p>';
      }
      ?>
    </div>
  </div>
</section>

<!-- FOUND SOMETHING -->
<section class="section" style="background-image: url('assets/images/found2.jpg');" data-aos="fade-up">
  <div class="overlay"></div>
  <div class="section-content">
    <h2>Found Something?</h2>
    <p>Do a good deed report the item you found so we can return it to its owner.</p>
    <a href="report-found.php" class="cta-btn">Report Found Item</a>
  </div>
</section>

<!-- RECENT FOUND ITEMS -->
<section class="section" style="background-image: url('assets/images/bg.jpg');" data-aos="fade-up">
  <div class="overlay"></div>
  <div class="section-content container">
    <h2>Recently Reported Found Items</h2>
    <div class="row">
      <?php
      $query = "SELECT * FROM items WHERE status = 'Found' ORDER BY date_lost_found DESC LIMIT 5";
      $result = mysqli_query($conn, $query);
      if ($result && mysqli_num_rows($result) > 0) {
        while ($item = mysqli_fetch_assoc($result)) {
          $image = !empty($item['image_path']) ? htmlspecialchars($item['image_path']) : 'assets/default-placeholder.png';
          echo '<div class="col-md-4 mb-4" data-aos="zoom-in">'
              . '<div class="card">'
              . '<img src="' . $image . '" class="card-img-top mx-auto d-block" alt="Item Image">'
              . '<div class="card-body">'
              . '<h5 class="card-title">' . htmlspecialchars($item['name']) . '</h5>'
              . '<p class="card-text">' . htmlspecialchars($item['description']) . '</p>'
              . '<a href="item-details.php?id=' . $item['id'] . '" class="btn btn-outline-light btn-sm">View</a>'
              . '</div>'
              . '</div>'
              . '</div>';
        }
      } else {
        echo '<p class="text-light">No found items yet.</p>';
      }
      $conn->close();
      ?>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<!-- HOW IT WORKS -->
<section class="section position-relative py-5 text-white" style="background-image: url('assets/images/bg1.jpg'); background-size: cover; background-position: center;" data-aos="fade-up">
  <!-- Dark overlay -->
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 40, 0.75); z-index: 1;"></div>

  <!-- Content -->
  <div class="container position-relative z-2 text-center">
    <h2 class="mb-5 fw-bold text-uppercase" style="letter-spacing: 1px;">How It Works</h2>

    <div class="row g-4">
      <!-- Step 1 -->
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="p-4 rounded-4 bg-dark bg-opacity-75 shadow text-white h-100">
          <div class="mb-3 display-6">📝</div>
          <h5 class="fw-semibold">1. Report</h5>
          <p class="small">Submit a detailed report of the item you lost or found to start the process.</p>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="p-4 rounded-4 bg-dark bg-opacity-75 shadow text-white h-100">
          <div class="mb-3 display-6">🔍</div>
          <h5 class="fw-semibold">2. Search</h5>
          <p class="small">Browse or search item listings that match your description and location.</p>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="p-4 rounded-4 bg-dark bg-opacity-75 shadow text-white h-100">
          <div class="mb-3 display-6">🤝</div>
          <h5 class="fw-semibold">3. Reunite</h5>
          <p class="small">Contact the owner or finder and safely reconnect with your belongings.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- FOOTER -->

 <?php
 include('includes/footer.php'); 
 ?>
<!-- <footer class="footer">
  <p>Contact Us: <a href="mailto:contact@sai-pali.com">contact@sai-pali.com</a></p>
  <p>&copy; 2025 Sai Pali Lost and Found. All rights reserved.</p>
</footer> -->

<script src="bootstrap-5/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>
