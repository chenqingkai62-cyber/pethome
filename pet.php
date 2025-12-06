<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Pet Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/iconfont/iconfont.css">
</head>

<body>
    <div class="main">
        <?php include 'header.php'; ?>
        <?php include 'conn.php'; ?>
        <div class="xtx_goods_topic xtx_panel">
            <div class="wrapper1">
                <div class="xtx_panel_header">
                    <h3>Pet Information<small>Cute pet Waiting for you to adopt</small></h3>
                    <form method="GET" action="" class="petform">
                        <select name="status" class="filter-select">
                            <option value="">All Statuses</option>
                            <option value="available" <?= ($_GET['status'] ?? '') == 'available' ? 'selected' : '' ?>>Available for adoption</option>
                            <option value="adopted" <?= ($_GET['status'] ?? '') == 'adopted' ? 'selected' : '' ?>>Adopted</option>
                        </select>
                        <select name="species" class="filter-select">
                            <option value="">All Statuses</option>
                            <option value="Dog" <?= ($_GET['species'] ?? '') == 'dog' ? 'selected' : '' ?>>Dog</option>
                            <option value="Cat" <?= ($_GET['species'] ?? '') == 'cat' ? 'selected' : '' ?>>Cat</option>
                        </select>
                        <select name="breed" class="filter-select">
                            <option value="">All varieties</option>
                            <?php
                            $breeds = $conn->query("SELECT DISTINCT breed FROM pets");
                            while ($breed = $breeds->fetch_assoc()) {
                                $selected = ($_GET['breed'] ?? '') == $breed['breed'] ? 'selected' : '';
                                echo "<option value='{$breed['breed']}' $selected>{$breed['breed']}</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="pagination-button">Filter</button>
                    </form>
                </div>

                <?php

                $status = $_GET['status'] ?? '';
                $species = $_GET['species'] ?? '';
                $breed = $_GET['breed'] ?? '';
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $itemsPerPage = 6;
                $offset = ($page - 1) * $itemsPerPage;
                $sql = "SELECT id, image_path, breed, age, gender, description, status FROM pets WHERE (status = 'available' OR status = 'adopted') ";
                if ($status) $sql .= "AND status = '$status' ";
                if ($species) $sql .= "AND species = '$species' ";
                if ($breed) $sql .= "AND breed = '$breed' ";
                $sql .= "LIMIT $offset, $itemsPerPage";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="xtx_topic"><ul class="clearfix">';
                    while ($row = $result->fetch_assoc()) {
                        $petDescription = mb_strlen($row['description'], 'UTF-8') > 15
                            ? mb_substr($row['description'], 0, 15, 'UTF-8') . '...'
                            : $row['description'];

                        $petInfo = htmlspecialchars($row['breed']) . " | " . $row['age'] . "old | " . ($row['gender'] == 'male' ? 'male' : 'female');

                        echo '<li>
                        <a href="pet_detail.php?id=' . $row['id'] . '">
                            <img src="' . $row['image_path'] . '" alt="Pet pictures">
                            <div class="meta">
                                <p class="title">' . $petInfo . '
                                    <small>' . htmlspecialchars($petDescription) . '</small>
                                </p>
                            </div>
                        </a>
                        <div class="social">
                            <span class="view">
                                <i class="iconfont">&#xe666;</i> ' . ($row['status'] == 'available' ? 'Available for adoption' : '<span style="color: red;">Adopted</span>') . '
                            </span>
                            <span class="reply">
                                <a href="pet_detail.php?id=' . $row['id'] . '"><i class="iconfont">&#xe668;</i> Learn more</a>
                            </span>
                        </div>
                    </li>';
                    }
                    echo '</ul></div>';
                } else {
                    echo "No pet information available";
                }

                $totalCount = $conn->query("SELECT COUNT(*) AS total FROM pets WHERE (status = 'available' OR status = 'adopted')")->fetch_assoc()['total'];
                $totalPages = ceil($totalCount / $itemsPerPage);

                if ($totalPages > 1) {
                    echo '<div class="pagination">';
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<a href="?page=' . $i . '" class="pagination-button' . ($i == $page ? ' active' : '') . '">' . $i . '</a>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <br>
    <?php include 'footer.php'; ?>
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/boost.js"></script>
    <script src="js/blast.min.js"></script>
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>