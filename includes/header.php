<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saipali Lost & Found</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        header {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 20px;
            background-color: rgb(2, 21, 41);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
            position: relative;
            z-index: 1000;
        }

        #brand {
            font-size: 1.5rem;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
            color:rgb(255, 255, 255);
            text-align: center;
            margin-bottom: 10px;
        }

        .navbar {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            transition: all 0.3s ease-in-out;
        }

        .navbar.sticky {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgb(2, 21, 41);
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            gap: 20px;
            flex-wrap: nowrap;
            flex-direction: row;
        }

        .nav-link, .btn {
            font-size: 1rem;
            color: #ffffff;
            padding: 10px 15px;
            background-color: rgb(3, 37, 76);
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .nav-link:hover, .btn:hover {
            background-color: rgb(255, 255, 255);
            color: rgb(3, 37, 76);
        }

        .btn-container {
            display: flex;
            gap: 15px;
        }

        .navbar-toggler {
            display: none;
            background-color: #ffffff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.5%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            display: block;
            width: 30px;
            height: 30px;
        }

        @media (max-width: 600px) {
            .navbar-toggler {
                display: inline-block;
            }
            
            .navbar-nav {
                flex-direction: column;
                flex-wrap: wrap;
            }

            .navbar-collapse {
                display: none;
                flex-direction: column;
                width: 100%;
                text-align: center;
            }
            
            .navbar-collapse.show {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <header>
    <div id="brand">
        <img src="assets/images/logo.png" alt="logo">
    </div>
        <div id="brand">SAI PALI LOST & FOUND</div>
        <button class="navbar-toggler" type="button" onclick="toggleNavbar()" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <nav class="navbar" id="navbar">
            <ul class="navbar-nav">
                <li><a class="nav-link" href="index.php">Home</a></li>
                <li><a class="nav-link" href="browse.php">Browse Items</a></li>
                <li><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li><a href="admin/login.php" class="btn">Admin Login</a></li>
                <li><a href="report-lost.php" class="btn">Report Lost</a></li>
                <li><a href="report-found.php" class="btn">Report Found</a></li>
            </ul>
        </nav>
    </header>

    <script>
        function toggleNavbar() {
            document.getElementById('navbarNav').classList.toggle('show');
        }

        window.addEventListener('scroll', function () {
            var navbar = document.getElementById("navbar");
            if (window.scrollY > 100) {
                navbar.classList.add("sticky");
            } else {
                navbar.classList.remove("sticky");
            }
        });
    </script>
</body>
</html>
