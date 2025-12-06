<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Pet Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link href="css/blast.min.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="main">
        <div id="page">
            <div id="home" class="banner" data-blast="bgColor">
                <?php
                include 'header.php';
                ?>
            </div>
        </div>
    </div>
    <section class="container1">
        <section class="wrapper">
            <header>
                <div class="logo">
                    <span><img src="./images/logo.jpg" alt=""></span>
                </div>
                <h1>Welcome!</h1>
                <p>User Registration</p>
            </header>
            <section class="main-content">
                <form action="register_process.php" method="post">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required pattern=".{6,}" title="The password must be at least 6 characters long">
                    <input type="password" name="repassword" placeholder="Confirm Password" required pattern=".{6,}" title="The password must be at least 6 characters long">
                    <input type="text" name="name" placeholder="Real Name" required>
                    <input type="text" name="phone" placeholder="Contact Information" required pattern="^\d{11}$" title="Please enter an 11-digit phone number">
                    <button type="submit" value="Registration Complete" class="over">Register</button>
                </form>

            </section>
            <footer1>
                <p>Already have an account?<a href="login.php" title="Register">Go log in</a></p>
            </footer1>
        </section>
    </section>

    <?php
    include 'footer.php';
    ?>
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/boost.js"></script>
    <script src="js/blast.min.js"></script>
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>