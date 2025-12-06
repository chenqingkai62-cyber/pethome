<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$comment_id = isset($_GET['comment_id']) ? intval($_GET['comment_id']) : 0;
$topic_id = isset($_GET['topic_id']) ? intval($_GET['topic_id']) : 0;

$current_user_id = $_SESSION['user_id'];

require_once 'conn.php';
$sql = "SELECT user_id FROM topic_comments WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $comment_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id);
    $stmt->fetch();

    if ($user_id == $current_user_id) {
        $delete_sql = "DELETE FROM topic_comments WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $comment_id);
        if ($delete_stmt->execute()) {
            header("Location: topic_detail.php?id=$topic_id");
            exit;
        } else {
            echo "Failed to delete comment!";
        }
    } else {
        echo "You do not have permission to delete this comment.";
    }
} else {
    echo "The comment does not exist.";
}

$stmt->close();
$conn->close();
?>
