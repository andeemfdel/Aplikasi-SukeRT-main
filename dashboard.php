<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">sukeRT</div>
            <ul>
                <li> <a href="#beranda" class="nav-link">Beranda</a></li>
                <li> <a href="#about" class="nav-link">Tentang Kami</a></li>
                <li> <a href="#fitur" class="nav-link">Fitur</a></li>
                <li> <a href="#kontak" class="nav-link">Kontak</a></li>
                <li> <a href="logout.php" class="nav-link">Logout</a></li>
                <li><a href="laporan.php" class="nav-link">Laporan</a></li>
            </ul>
        </nav>
    </header>

    <section id="dashboard">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <p>This is your dashboard.</p>
    </section>

    <!-- Include the rest of your dashboard content here -->

</body>
</html>
