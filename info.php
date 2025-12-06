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
                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "<script>alert('Please log in first');window.location.href='login.php';</script>";
                        exit();
                    }
                    $user_id = $_SESSION['user_id'];

                    $sql = "SELECT username, real_name, contact_info, created_at, updated_at FROM users WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $user = $result->fetch_assoc();
                    } else {
                        echo "User information not found";
                        exit;
                    }

                    $stmt->close();
                    $conn->close();
                    ?>

                    <div class="pannel orders">
                        <div class="pannel_title">
                            <h4>My information</h4>
                        </div>
                        <div class="content">
                            <form id="userInfoForm" method="post" action="action/update_user_info.php">
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="real_name">Real Name:</label>
                                    <input type="text" id="real_name" name="real_name" class="form-control" value="<?php echo htmlspecialchars($user['real_name']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="contact_info">Contact Information:</label>
                                    <input type="text" id="contact_info" name="contact_info" class="form-control" value="<?php echo htmlspecialchars($user['contact_info']); ?>">
                                </div>

                                <div class="form-group form-group1">
                                    <label for="created_at" class="time-label">Registration Time: <span class="time-text"><?php echo htmlspecialchars($user['created_at']); ?></span></label>
                                    <label for="updated_at" class="time-label">Last modified time: <span class="time-text"><?php echo htmlspecialchars($user['updated_at']); ?></span></label>

                                </div>

                                <div class="form-group">
                                    <button type="submit" id="submitBtn" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const form = document.getElementById('userInfoForm');
                                const submitBtn = document.getElementById('submitBtn');

                                const originalValues = {
                                    username: document.getElementById('username').value,
                                    real_name: document.getElementById('real_name').value,
                                    contact_info: document.getElementById('contact_info').value
                                };

                                form.addEventListener('submit', function(e) {
                                    const username = document.getElementById('username').value.trim();
                                    const realName = document.getElementById('real_name').value.trim();
                                    const contactInfo = document.getElementById('contact_info').value.trim();

                                    if (username === '' || realName === '' || contactInfo === '') {
                                        alert('All fields are required');
                                        e.preventDefault();
                                        return;
                                    }

                                    if (username.length < 6) {
                                        alert('Username must be at least 6 characters long');
                                        e.preventDefault();
                                        return;
                                    }

                                    if (username === originalValues.username &&
                                        realName === originalValues.real_name &&
                                        contactInfo === originalValues.contact_info) {
                                        alert('No modifications');
                                        e.preventDefault();
                                        return;
                                    }

                                    if (!/^\d{11}$/.test(contactInfo)) {
                                        alert('The contact number must be 11 digits long');
                                        e.preventDefault(); 
                                        return;
                                    }
                                });
                            });
                        </script>
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