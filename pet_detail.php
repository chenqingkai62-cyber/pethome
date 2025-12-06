<?php
session_start();
if (!isset($_SESSION['user_id'])) {

    echo "<script>alert('Please log in first'); window.location.href = 'login.php';</script>";
    exit;
}

require_once 'conn.php';

$pet_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

$pet_sql = "SELECT id, name, species, breed, age, gender, description, image_path, status, created_at FROM pets WHERE id = $pet_id";
$pet_result = $conn->query($pet_sql);
$pet = $pet_result->fetch_assoc();

$gender = $pet['gender'] === 'male' ? 'male' : 'female';

$adopt_button = $pet['status'] === 'available' ? '<button id="apply-adopt-btn" data-pet-id="' . $pet['id'] . '">Apply for Adoption</button>' : '<button onclick="history.back()" id="add-to-index">Already adopted, click to return</button>';
?>

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
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/goodsdetail.css">
    <link rel="stylesheet" href="css/iconfont/iconfont.css">
</head>

<body>
    <div class="main">
        <?php include 'header.php'; ?>
        <?php include 'conn.php'; ?>
        <div class="container">
            <div class="product-details">
                <div class="product-images">
                    <div class="preview_img">
                        <img src="<?php echo htmlspecialchars($pet['image_path']); ?>" alt="Pet pictures" class="main-image" data-magnified-url="<?php echo htmlspecialchars($pet['image_path']); ?>">
                    </div>
                </div>

                <div class="product-info">
                    <br>
                    <br>
                    <h1><?php echo htmlspecialchars($pet['name']); ?></h1>
                    <p class="description"><?php echo htmlspecialchars($pet['description']); ?></p>
                    <p class="petinfo">Variety:<span style="color:#777;"><?php echo htmlspecialchars($pet['breed']); ?></span></p>
                    <p class="petinfo">Age:<span style="color:#777;"><?php echo htmlspecialchars($pet['age']); ?>岁</span></p>
                    <p class="petinfo">Gender:<span style="color:#777;"><?php echo $gender; ?></span></p>
                    <p class="petinfo">Release Time:<small style="color:#777;"><?php echo htmlspecialchars($pet['created_at']); ?></small></p>
                    <input type="hidden" id="pet-id" value="<?php echo htmlspecialchars($pet_id); ?>" />
                    <div class="bbtn">
                        <?php echo $adopt_button; ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="message-box" class="message-box"></div>
    </div>
    <br>
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/boost.js"></script>
    <script src="js/blast.min.js"></script>
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const adoptButton = document.getElementById('apply-adopt-btn');
            const petId = document.getElementById('pet-id').value;
            const messageBox = document.getElementById('message-box');

            adoptButton.addEventListener('click', function() {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'action/apply_adoption.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const responseText = xhr.responseText.trim();

                        if (responseText === 'Adoption application has been submitted') {
                            messageBox.textContent = 'Adoption application submitted, awaiting review';
                            messageBox.style.backgroundColor = '#4CAF50'; 
                        } else {
                            messageBox.textContent = responseText;
                            messageBox.style.backgroundColor = '#f44336';
                        }

                        messageBox.classList.add('show');
                        setTimeout(() => {
                            messageBox.classList.remove('show');
                            window.location.reload();
                        }, 1200);
                    }
                };
                xhr.send(`pet_id=${petId}`);
            });
        });
    </script>
</body>

</html>