<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Pet Home - My message</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/blast.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/info.css">
    <link rel="stylesheet" href="css/center.css">
</head>

<body>
    <div class="main">
        <div id="page">
            <div id="home" class="banner" data-blast="bgColor">
                <?php include 'header.php'; ?>
            </div>
        </div>
    </div>
    <section class="info-sec parallax-section py-lg-5 py-4" id="messages">
        <br>
        <br>
        <div class="xtx_body">
            <div class="wrapper">
                <?php include 'aside.php'; ?>
                <div class="main">
                    <?php include 'top.php'; ?>
                    <div class="pannel messages">
                        <div class="pannel_title">
                            <h4>My message</h4>
                        </div>
                        <div class="message-list">
                            <?php
                            $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_message_id'])) {
                                $message_id = intval($_POST['delete_message_id']);
                                $conn->query("DELETE FROM message_replies WHERE message_id = $message_id");
                                $conn->query("DELETE FROM message WHERE id = $message_id AND user_id = $user_id");
                            }

                            $sql = "SELECT id, name, contact, content, created_at FROM message WHERE user_id = $user_id ORDER BY created_at DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $message_id = htmlspecialchars($row['id']);
                                    $name = htmlspecialchars($row['name']);
                                    $contact = htmlspecialchars($row['contact']);
                                    $content = htmlspecialchars($row['content']);
                                    $created_at = htmlspecialchars($row['created_at']);

                                    echo '<div class="message-card">';
                                    echo "<div class='message-content'>
                                    <strong>$name</strong> ($contact) in $created_at Message:<br>
                                    <div class='messcontent'><img src='./images/tw.svg' alt=''><span class='messcontent-span'>$content<span></div>
                                    </div>";

                                    $reply_sql = "
                                        SELECT 
                                            message_replies.reply_content, 
                                            message_replies.created_at, 
                                            users.real_name, 
                                            users.avatar 
                                        FROM 
                                            message_replies 
                                        JOIN 
                                            users ON message_replies.user_id = users.id 
                                        WHERE 
                                            message_replies.message_id = $message_id 
                                        ORDER BY 
                                            message_replies.created_at ASC";
                                    $reply_result = $conn->query($reply_sql);

                                    if ($reply_result->num_rows > 0) {
                                        while ($reply = $reply_result->fetch_assoc()) {
                                            $reply_content = htmlspecialchars($reply['reply_content']);
                                            $reply_created_at = htmlspecialchars($reply['created_at']);
                                            $reply_real_name = htmlspecialchars($reply['real_name']);
                                            $reply_avatar = htmlspecialchars($reply['avatar']);

                                            echo "<div class='reply-content'>
                                                    <img src='$reply_avatar' alt='$reply_real_name' class='reply-avatar'>
                                                    <span class='reply-name'>$reply_real_name</span> Reply: $reply_content 
                                                    <span class='reply-timestamp'>($reply_created_at)</span>
                                                  </div>";
                                        }
                                    } else {
                                        echo "<div class='reply-content'>
                                                  <span class='no-reply'>No reply yet</span>
                                              </div>";
                                    }

                                    echo '<form method="POST" style="margin-top: 10px;">';
                                    echo "<input type='hidden' name='delete_message_id' value='$message_id'>";
                                    echo '<button type="submit" class="delete-button">delete</button>';
                                    echo '</form>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<p>No message records yet.</p>';
                            }

                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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