<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
$isAdmin = isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1;
?>
<div class="navbardiv">
    <nav class="navbar navbar-expand-lg mb-4 top-bar navbar-static-top sps sps--abv">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse1" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>
            <a class="navbar-brand mx-auto" href="index.php">pet <span data-blast="color">home</span></a>
            <div class="collapse navbar-collapse" id="navbarCollapse1">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"> <a class="nav-link" href="index.php">Home </a> </li>
                    <li class="nav-item"> <a class="nav-link" href="topics.php">Pet Special</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="pet.php">Pet Adoption</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="contact.php">Contact/Book</a> </li>
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item"> <a class="nav-link" href="info.php">Welcome:<?php echo htmlspecialchars($_SESSION['username']); ?></a> </li>
                        <li class="nav-item"> <a class="nav-link" href="info.php">Personal Center</a> </li>
                        <?php if ($isAdmin): ?>
                            <li class="nav-item"> <a class="nav-link" href="admin/index.php">Enter the backend</a> </li>
                        <?php endif; ?>
                        <li class="nav-item"> <a class="nav-link" href="logout.php">Log out</a> </li>
                    <?php else: ?>
                        <li class="nav-item"> <a class="nav-link" href="login.php">Log In/Register</a> </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</div>