<footer class="footer text-center mt-5">
  <div class="container">
   
    
    <!-- Navigation Links -->
    <ul class="list-inline mb-3">
      <li class="list-inline-item"><a href="index.php">Home</a></li>
      <li class="list-inline-item"><a href="browse.php">Browse Items</a></li>
      <li class="list-inline-item"><a href="report-lost.php">Report Lost</a></li>
      <li class="list-inline-item"><a href="report-found.php">Report Found</a></li>
      <li class="list-inline-item"><a href="how-it-works.php">How It Works</a></li>
      <li class="list-inline-item"><a href="faq.php">FAQs</a></li>
      <li class="list-inline-item"><a href="contact.php">Contact</a></li>
      <li class="list-inline-item"><a href="privacy-policy.php">Privacy Policy</a></li>
      <li class="list-inline-item"><a href="terms.php">Terms of Service</a></li>
    </ul>

    <!-- Optional Newsletter Signup -->
    <form class="d-flex justify-content-center mb-3" action="subscribe.php" method="post">
      <input type="email" name="email" class="form-control w-auto me-2" placeholder="Your email" required>
      <button type="submit" class="btn btn-outline-light">Subscribe</button>
    </form>

    <!-- Social Media -->
    <div class="social-icons">
      <a href="#" class="text-white mx-2" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
      <a href="#" class="text-white mx-2" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
      <a href="#" class="text-white mx-2" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
      <a href="#" class="text-white mx-2" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
      <a href="#" class="text-white mx-2" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
      <a href="#" class="text-white mx-2" aria-label="GitHub"><i class="bi bi-github"></i></a>
    </div>

    <!-- copyright -->
    <p class="mb-2">&copy; 2025 Saipali Lost & Found. All rights reserved.</p>
  </div>
</footer>

<!-- Styles -->
<style>
  .footer {
    background-color: rgb(2, 21, 41);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    color: #fff;
    padding: 40px 0;
    font-size: 0.95rem;
  }

  .footer a {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s ease, font-weight 0.3s ease;
  }

  .footer a:hover {
    color: rgb(7, 220, 253);
    font-weight: bold;
  }

  .social-icons a {
    font-size: 1.4rem;
    transition: transform 0.3s ease, color 0.3s ease;
  }

  .social-icons a:hover {
    transform: scale(1.1);
    color: rgb(7, 220, 253);
  }

  @media (max-width: 576px) {
    .footer ul.list-inline {
      display: flex;
      flex-direction: column;
      gap: 8px;
      padding-left: 0;
    }

    .footer form {
      flex-direction: column;
    }

    .footer form input,
    .footer form button {
      width: 100% !important;
      margin-bottom: 10px;
    }
  }
</style>

<!-- Required Bootstrap & Icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
