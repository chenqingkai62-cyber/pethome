<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Pet Home</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link href="css/blast.min.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/lightbox.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/iconfont/iconfont.css">

</head>

<body>
    <div class="main">
        <div id="page">
            <div id="home" class="banner" data-blast="bgColor">
                <?php
                include 'header.php';
                ?>
                <section class="banner1">
                    <div class="wrapper1">
                        <?php
                        include 'conn.php';

                        $sql = "SELECT * FROM categories LIMIT 8";
                        $result = $conn->query($sql);

                        $categories = [];
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $categories[] = $row;
                            }
                        }
                        ?>
                        <ul class="banner1-left">

                            <li>
                                <a href="shop.php">
                                    <span>Home</span>
                                    <span class="iconfont">&#xe687;</span>
                                </a>
                            </li>
                            <?php foreach ($categories as $category): ?>
                                <li>
                                    <a href="categories.php?id=<?php echo $category['id']; ?>">
                                        <span><?php echo htmlspecialchars($category['category_name']); ?></span>
                                        <span class="iconfont">&#xe687;</span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
        <div class="wrapper2">
            <div class="header-search">
                <form action="all_products.php" method="GET">
                    <input type="text" name="search" placeholder="Search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <span class="iconfont">&#xe67d;</span>
                    </button>
                </form>
            </div>
            <?php
            $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
            $item_count = 0; 

            if ($user_id > 0) {
                $cart_count_sql = "SELECT COUNT(*) AS item_count FROM cart_items WHERE user_id = $user_id";
                $cart_count_result = $conn->query($cart_count_sql);

                if ($cart_count_result) {
                    $item_count_row = $cart_count_result->fetch_assoc();
                    $item_count = $item_count_row['item_count'];
                }
            }
            ?>
            <a href="cart.php">
                <span class="iconfont">&#xe746;</span> 
                <span class="num-position"><?php echo intval($item_count); ?></span> 
            </a>
        </div>

        <div class="xtx_goods_new xtx_panel">
            <div class="wrapper">
                <?php

                $category_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                if ($category_id > 0) {
                    $category_query = "SELECT category_name FROM categories WHERE id = $category_id";
                    $category_result = $conn->query($category_query);

                    if ($category_result->num_rows > 0) {
                        $category_row = $category_result->fetch_assoc();
                        $category_name = htmlspecialchars($category_row['category_name']);

                        echo '<div class="xtx_panel_header">';
                        echo '<h3>Pet' . $category_name . '</h3>';
                        echo '</div>';
                    } else {
                        echo '<div class="xtx_panel_header">';
                        echo '<h3>Category Products<small>All products under the category</small></h3>';
                        echo '</div>';
                    }


                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                    $limit = 4;
                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT id, image_path, name, price FROM products WHERE category_id = $category_id LIMIT $limit OFFSET $offset";
                    $count_sql = "SELECT COUNT(*) as total FROM products WHERE category_id = $category_id";

                    $result = $conn->query($sql);
                    $count_result = $conn->query($count_sql);
                    $total_items = $count_result->fetch_assoc()['total'];
                    $total_pages = ceil($total_items / $limit);

                    if ($result->num_rows > 0) {
                        echo '<div class="xtx_panel_goods_1">';
                        while ($row = $result->fetch_assoc()) {
                            $display_name = mb_substr($row['name'], 0, 15, 'utf-8');
                            if (mb_strlen($row['name'], 'utf-8') > 15) {
                                $display_name .= '...';
                            }
                            echo '<a href="detail.php?id=' . htmlspecialchars($row['id']) . '">';
                            echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                            echo '<span class="name">' . htmlspecialchars($display_name) . '</span>';
                            echo '<div class="price-container">';
                            if ($row['discount_price'] !== null) {

                                echo '<span class="price discount"><small>￥</small>' . htmlspecialchars($row['discount_price']) . '</span>';
                                echo '<span class="price old"><small>￥</small>' . htmlspecialchars($row['price']) . '</span>';
                            } else {
                                echo '<span class="price"><small>￥</small>' . htmlspecialchars($row['price']) . '</span>';
                            }
                            echo '</div>';
                            echo '</a>';
                        }
                        echo '</div>';
                    } else {
                        echo '<div class="no-products">';
                        echo '<img src="./images/zwsp.svg" alt="No products">';
                        echo '</div>';
                    }


                    echo '<div class="pagination">';
                    if ($page > 1) {
                        echo '<a href="categories.php?id=' . $category_id . '&page=' . ($page - 1) . '" class="prev">Previous page</a>';
                    }

                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo '<a href="categories.php?id=' . $category_id . '&page=' . $i . '" ' . ($i == $page ? 'class="active"' : '') . '>' . $i . '</a>';
                    }

                    if ($page < $total_pages) {
                        echo '<a href="categories.php?id=' . $category_id . '&page=' . ($page + 1) . '" class="next">Next page</a>';
                    }
                    echo '</div>';
                } else {
                    echo 'Invalid category ID';
                }
                ?>
            </div>
        </div>
    </div>
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