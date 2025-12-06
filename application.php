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
                <?php
                include 'aside.php';
                ?>

                <div class="main">
                    <?php
                    include 'top.php';
                    ?>
                    <div class="pannel orders">
                        <div class="pannel_title">
                            <h4>Adoption Records</h4>
                        </div>
                        <div class="recharge">
                            <div class="transaction-records">
                                <div class="form-group">
                                    <label>Adoption Records:</label>
                                </div>
                                <?php
                                $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

                                $sql = "SELECT a.id, p.id AS pet_id, p.image_path, p.name AS pet_name, a.adoption_date, a.status 
                                        FROM adoption_records a 
                                        LEFT JOIN pets p ON a.pet_id = p.id 
                                        WHERE a.user_id = $user_id 
                                        ORDER BY a.adoption_date DESC";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    echo '<table>
                                        <thead>
                                            <tr>
                                                <th>Serial Number</th>
                                                <th>Pet pictures</th>
                                                <th>Pet Name</th>
                                                <th>Adoption Time</th>
                                                <th>Review Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                    $index = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $pet_id = htmlspecialchars($row['pet_id']);
                                        $adopted_at = htmlspecialchars($row['adoption_date']);
                                        $status = htmlspecialchars($row['status']);
                                        $status_text = $status == 'approved' ? 'Approved' : ($status == 'pending' ? 'Pending Review' : 'Not passed');
                                        echo '<tr>
                                            <td>' . $index++ . '</td>
                                            <td><img src="' . htmlspecialchars($row['image_path']) . '" alt="Pet pictures"></td>
                                            <td><a href="pet_detail.php?id=' . $pet_id . '">' . htmlspecialchars($row['pet_name']) . '</a></td>
                                            <td>' . $adopted_at . '</td>
                                            <td>' . $status_text . '</td>
                                          </tr>';
                                    }
                                    echo '</tbody></table>';
                                } else {
                                    echo '<p>No adoption records available.</p>';
                                }

                                $conn->close();
                                ?>
                            </div>
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