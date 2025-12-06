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
                            <h4>Appointment Records</h4>
                        </div>
                        <div class="recharge">
                            <div class="transaction-records">
                                <div class="form-group">
                                    <label>Appointment Records:</label>
                                </div>
                                <?php
                                $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_appointment_id'])) {
                                    $appointment_id = intval($_POST['delete_appointment_id']);
                                    $delete_sql = "DELETE FROM appointments WHERE id = $appointment_id AND user_id = $user_id";
                                    $conn->query($delete_sql);
                                }

                                $sql = "SELECT id, name, phone, service, created_at 
                                        FROM appointments 
                                        WHERE user_id = $user_id 
                                        ORDER BY created_at DESC";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo '<table>
                                        <thead>
                                            <tr>
                                                <th>Serial Number</th>
                                                <th>Name</th>
                                                <th>Contact Information</th>
                                                <th>Appointment Service</th>
                                                <th>Appointment time</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                    $index = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $appointment_id = htmlspecialchars($row['id']);
                                        $name = htmlspecialchars($row['name']);
                                        $phone = htmlspecialchars($row['phone']);
                                        $service = htmlspecialchars($row['service']);
                                        $created_at = htmlspecialchars($row['created_at']);
                                        echo '<tr>
                                            <td>' . $index++ . '</td>
                                            <td>' . $name . '</td>
                                            <td>' . $phone . '</td>
                                            <td>' . $service . '</td>
                                            <td>' . $created_at . '</td>
                                            <td>
                                                <form method="POST" style="display:inline;">
                                                    <input type="hidden" name="delete_appointment_id" value="' . $appointment_id . '">
                                                    <button type="submit" class="btn btn-danger btn-sm">delete</button>
                                                </form>
                                            </td>
                                          </tr>';
                                    }
                                    echo '</tbody></table>';
                                } else {
                                    echo '<p>No appointment records.</p>';
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