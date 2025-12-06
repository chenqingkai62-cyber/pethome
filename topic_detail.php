<?php
include 'conn.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in first.'); window.location.href = 'login.php';</script>";
    exit;
}
$topic_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM topics WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $topic_id);
$stmt->execute();
$result = $stmt->get_result();
$topic = $result->fetch_assoc();

if ($topic) {
    $update_sql = "UPDATE topics SET views = views + 1 WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $topic_id);
    $update_stmt->execute();
}
?>
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
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/topic.css">
    <link rel="stylesheet" href="css/iconfont/iconfont.css">

</head>

<body>
    <div class="main">
        <div id="page">
            <div id="home" class="banner" data-blast="bgColor">
                <?php
                include 'header.php';
                ?>
            </div>
            <div class="topic-detail">
                <div class="topic-header">
                    <h1><?php echo htmlspecialchars($topic['title']); ?></h1>
                    <div class="meta">
                        <span class="views view"><i class="sprites"></i>Pageviews: <?php echo htmlspecialchars($topic['views']); ?></span>
                        <span class="created-at">Release time: <?php echo htmlspecialchars(date('Y-m-d', strtotime($topic['created_at']))); ?></span>
                    </div>
                </div>
                <div class="topic-image">
                    <img src="<?php echo htmlspecialchars($topic['image_path']); ?>" alt="<?php echo htmlspecialchars($topic['title']); ?>">
                </div>
                <div class="topic-content">
                    <h2></h2>
                    <p><?php echo nl2br(htmlspecialchars($topic['content'])); ?></p>
                </div>
            </div>

            <div class="detailinfo">
                <div class="divider"></div>
                <div class="buttons">
                    <button class="btn-detail active">All comments</button>
                    <button class="btn-evaluate">Post a comment</button>
                </div>
                <div class="content">
                    <?php
                    require_once 'conn.php';

                    $topic_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                    session_start();
                    $current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

                    $sql = "SELECT c.id, c.comment, c.created_at, u.username, u.avatar, c.user_id
                    FROM topic_comments c
                    JOIN users u ON c.user_id = u.id
                    WHERE c.topic_id = ?
                    ORDER BY c.created_at DESC";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $topic_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    ?>

                    <div class="detail-content">
                        <div class="container comment-container">
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <div class="comment">
                                        <div class="comment-avatar">
                                            <img src="<?php echo htmlspecialchars($row['avatar']); ?>" alt="<?php echo htmlspecialchars($row['username']); ?>">
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-user"><?php echo htmlspecialchars($row['username']); ?></div>
                                            <p class="comment-text"><?php echo htmlspecialchars($row['comment']); ?></p>
                                            <div class="comment-time"><?php echo htmlspecialchars($row['created_at']); ?></div>

                                            <?php if ($row['user_id'] == $current_user_id): ?>
                                                <a href="delete_comment.php?comment_id=<?php echo $row['id']; ?>&topic_id=<?php echo $topic_id; ?>" class="delete-comment" onclick="return confirm('Are you sure you want to delete this comment?');">delete</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>no comments</p>
                            <?php endif; ?>

                            <?php
                            $stmt->close();
                            $conn->close();
                            ?>
                        </div>
                    </div>

                    <div class="evaluate-content" style="display: none;">
                        <div class="form-container">
                            <form action="action/submit_comment.php" method="POST">
                                <input type="hidden" name="topic_id" value="<?php echo htmlspecialchars($topic_id); ?>">
                                <div class="form-group">
                                    <label for="comment">Comment content:</label>
                                    <textarea id="comment" name="comment" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn-submit">Submit a comment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php
    include 'footer.php';
    ?>
    <script>
        const btnDetail = document.querySelector(".btn-detail");
        const btnEvaluate = document.querySelector(".btn-evaluate");
        const detailContent = document.querySelector(".detail-content");
        const evaluateContent = document.querySelector(".evaluate-content");

        detailContent.style.display = "block";
        evaluateContent.style.display = "none";

        btnDetail.addEventListener("click", function() {
            btnDetail.classList.add("active");
            btnEvaluate.classList.remove("active");
            detailContent.style.display = "block";
            evaluateContent.style.display = "none";
        });

        btnEvaluate.addEventListener("click", function() {
            btnDetail.classList.remove("active");
            btnEvaluate.classList.add("active");
            detailContent.style.display = "none";
            evaluateContent.style.display = "block";
        });
    </script>
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/boost.js"></script>
    <script src="js/blast.min.js"></script>
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>