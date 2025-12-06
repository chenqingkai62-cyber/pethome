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
    <link rel="stylesheet" href="css/info.css">
    <link rel="stylesheet" href="css/center.css">
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

                <?php include 'aside.php'; ?>

                <div class="main">
                    <?php include 'top.php'; ?>

                    <?php
                    if (!isset($_SESSION['user_id'])) {
                        echo "User not logged in";
                        exit;
                    }
                    $user_id = $_SESSION['user_id'];

                    $sql = "SELECT username, real_name, contact_info, address, created_at, updated_at FROM users WHERE id = ?";
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
                    ?>
                    <div class="pannel orders">
                        <div class="pannel_title">
                            <h4>Address Management</h4>
                        </div>
                        <div class="content">
                            <p><strong>Current Address:</strong>
                                <span>
                                    <?php
                                    if (!empty($user['address'])) {
                                        echo htmlspecialchars($user['address']);
                                    } else {
                                        echo "<span style='color:red;'>Address information has not been uploaded yet</span>";
                                    }
                                    ?>
                                </span>
                            </p>
                            <br>
                            <form id="userInfoForm" method="post" action="action/update_user_address.php">
                                <div class="address-form">
                                    <div class="form-group">
                                        <label for="province">Province:</label>
                                        <select id="province" name="province" onchange="doProvAndCityRelation();">
                                            <option id="choosePro" value="-1">Please select a province</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="citys">city:</label>
                                        <select id="citys" name="city" onchange="doCityAndCountyRelation();">
                                            <option id="chooseCity" value="-1">Please select a city</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="county">district/county:</label>
                                        <select id="county" name="county">
                                            <option id="chooseCounty" value="-1">Please select district/county</option>

                                        </select>
                                    </div>

                                    <input type="hidden" id="provinceInput" name="provinceInput" value="">
                                    <input type="hidden" id="cityInput" name="cityInput" value="">
                                    <input type="hidden" id="countyInput" name="countyInput" value="">

                                    <div class="form-group">
                                        <label for="detailAddress">Detailed address:</label>
                                        <input type="text" id="detailAddress" name="detailAddress" placeholder="Please enter the detailed address" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
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
    <script src="js/region.js"></script>
    <script>
        var provinceSelect = document.getElementById('province');
        var citySelect = document.getElementById('citys');
        var countySelect = document.getElementById('county');


        var provinceInput = document.getElementById('provinceInput');
        var cityInput = document.getElementById('cityInput');
        var countyInput = document.getElementById('countyInput');


        provinceSelect.addEventListener('change', function() {
            provinceInput.value = provinceSelect.options[provinceSelect.selectedIndex].text;
        });

        citySelect.addEventListener('change', function() {
            cityInput.value = citySelect.options[citySelect.selectedIndex].text;
        });

        countySelect.addEventListener('change', function() {
            countyInput.value = countySelect.options[countySelect.selectedIndex].text;
        });
    </script>
</body>

</html>