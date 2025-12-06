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
    <link rel="stylesheet" href="css/lightbox.css">
    <link rel="stylesheet" href="css/center.css">
    <link rel="stylesheet" href="css/info.css">
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
    <section class="info-sec parallax-section py-lg-5 py-4" id="book">
        <br>
        <br>
        <div class="xtx_body">
            <div class="wrapper">
                <?php
                include 'aside.php';
                ?>

                <div class="main">
                    <?php
                    include 'top.php';
                    ?>
                    <div class="pannel orders">
                        <div class="pannel_title">
                            <h4>Change Password</h4>
                        </div>
                        <div class="content">
                            <form id="userPassForm" method="post" action="action/update_user_password.php">
                                <div class="form-group">
                                    <label for="oldpassword">Original password:</label>
                                    <input type="password" id="oldpassword" name="oldpassword" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="password">New password:</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="confirm">Confirm Password:</label>
                                    <input type="password" id="confirm" name="confirm" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button type="submit" id="submitBtn" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>

                            <script>
                                document.getElementById('userPassForm').addEventListener('submit', function(event) {
                                    var oldPassword = document.getElementById('oldpassword').value.trim();
                                    var newPassword = document.getElementById('password').value.trim();
                                    var confirmPassword = document.getElementById('confirm').value.trim();

                                    if (oldPassword === '' || newPassword === '' || confirmPassword === '') {
                                        alert('All fields are required');
                                        event.preventDefault();
                                        return;
                                    }
                                    if (newPassword !== confirmPassword) {
                                        alert('The new password and confirmation password do not match');
                                        event.preventDefault();
                                        return;
                                    }

                                    if (newPassword.length < 6) {
                                        alert('The password must be at least 6 characters long');
                                        event.preventDefault(); 
                                        return;
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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