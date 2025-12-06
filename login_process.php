<?php
require_once 'conn.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $remember_me = isset($_POST['remember_me']) ? $_POST['remember_me'] : null;

    if (empty($username) || empty($password)) {
        echo "<script>alert('Username and password cannot be empty!');window.history.back();</script>";
        exit;
    }

    $sql = "SELECT id, username, password, isadmin FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_username, $db_password, $isadmin);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $db_username;
            $_SESSION['isadmin'] = $isadmin;

            if ($remember_me) {
                $token = bin2hex(random_bytes(16)); 
                setcookie("remember_me", $token, time() + (7 * 24 * 60 * 60), "/");  

            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Incorrect password!');window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Username does not exist!');window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
}