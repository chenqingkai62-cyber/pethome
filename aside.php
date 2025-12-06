<?php
require_once 'conn.php';
session_start();
$userId = $_SESSION['user_id'];

$sql = "SELECT real_name, avatar, isadmin FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$userResult = $stmt->get_result();

$real_name = 'Not logged in';
$avatar = 'uploads/avatar/default.jpg';

if ($userResult && $userResult->num_rows > 0) {
    $user = $userResult->fetch_assoc();
    $real_name = htmlspecialchars($user['real_name']);
    $avatar = htmlspecialchars($user['avatar']);
    $isAdmin = $user['isadmin'];

    if (empty($avatar)) {
        $avatar = 'uploads/avatar/default.jpg';
    }
} else {
    $real_name = 'Not logged in';
    $avatar = 'uploads/avatar/default.jpg';
}
?>

<div class="aside">
    <div class="touxiang">
        <img src="<?php echo $avatar; ?>" alt="User Avatar">
    </div>
    <div class="name">
        <span><?php echo $real_name; ?></span>
    </div>
</div>