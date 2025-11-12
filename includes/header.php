<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LT Software - Construction Software Solutions</title>
    <meta name="description" content="Leading provider of construction cost estimation and project management software">
    <?php
        $base_path = '/';
        if (strpos($_SERVER['REQUEST_URI'], '/netcost/') !== false) {
            $base_path = '/netcost/';
        }
    ?>
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/styles.css?v=<?php echo time() % 100000; ?>">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <header class="site-header">
        <nav class="navbar">
            <div class="container">
                <a href="<?php echo $base_path; ?>index.php" class="logo">
                    <img src="<?php echo $base_path; ?>assets/media/LT.svg" alt="LT Construction" class="logo-image" style="height: 40px; width: auto;">
                </a>
                
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <div class="nav-menu" id="navMenu">
                    <a href="<?php echo $base_path; ?>about.php" class="nav-link">About</a>
                    <a href="<?php echo $base_path; ?>services.php" class="nav-link">Services</a>
                    <a href="<?php echo $base_path; ?>index.php#products" class="nav-link">Products</a>
                    <a href="<?php echo $base_path; ?>team.php" class="nav-link">Team</a>
                    <a href="<?php echo $base_path; ?>clients.php" class="nav-link">Clients</a>
                    <a href="<?php echo $base_path; ?>references.php" class="nav-link">References</a>
                    <a href="<?php echo $base_path; ?>news.php" class="nav-link">News</a>
                    <a href="<?php echo $base_path; ?>contact.php" class="btn btn-primary btn-small">Contact Us</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
