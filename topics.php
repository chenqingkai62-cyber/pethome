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
  <link rel="stylesheet" href="css/shop.css">
  <link rel="stylesheet" href="css/iconfont/iconfont.css">

</head>

<body>
  <?php
  include 'header.php';
  ?>
  <div class="main">
    <?php
    include 'conn.php';
    ?>

    <div class="xtx_goods_topic xtx_panel">
      <div class="wrapper1">
        <div class="xtx_panel_header">
          <h3>Latest Special<small>Hot Topics Connecting Life</small></h3>
          <!-- <a href="all_topics.php" class="more">
                        View all<i class="sprites"></i>
                    </a> -->
        </div>
        <?php
        $sql = "SELECT t.id, t.image_path, t.title, t.description, t.views, 
        (SELECT COUNT(*) FROM topic_comments c WHERE c.topic_id = t.id) AS comment_count
        FROM topics t";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo '<div class="xtx_topic">
            <ul class="clearfix">';
          while ($row = $result->fetch_assoc()) {
            $description = mb_strlen($row['description'], 'UTF-8') > 15
              ? mb_substr($row['description'], 0, 15, 'UTF-8') . '...'
              : $row['description'];

            echo '<li>
                <a href="topic_detail.php?id=' . $row['id'] . '">
                  <img src="' . $row['image_path'] . '" alt="">
                  <div class="meta">
                    <p class="title">' . htmlspecialchars($row['title']) . '
                      <small>' . htmlspecialchars($description) . '</small>
                    </p>
                  </div>
                </a>
                <div class="social">
                  <span class="view">
                    <i class="iconfont">&#xe666;</i>' . $row['views'] . '
                  </span>
                  <span class="reply">
                    <i class="iconfont">&#xe668;</i>' . $row['comment_count'] . '
                  </span>
                </div>
              </li>';
          }

          echo '</ul>
          </div>';
        } else {
          echo "No special topic information available.";
        }
        ?>
      </div>
    </div>
  </div>
  <br>
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