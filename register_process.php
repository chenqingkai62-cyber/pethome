<?php
require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $real_name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : '';

    if (empty($username) || empty($real_name) || empty($phone) || empty($password) || empty($repassword)) {
        echo "<script>alert('All fields are required!');window.history.back();</script>";
        exit;
    }

    if ($password !== $repassword) {
        echo "<script>alert('The two passwords do not match!');window.history.back();</script>";
        exit;
    }

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists!');window.history.back();</script>";
        exit;
    }
    $stmt->close();

    $sql = "SELECT * FROM users WHERE contact_info = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('The phone number has already been registered!');window.history.back();</script>";
        exit;
    }
    $stmt->close();

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password, real_name, contact_info) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $hashed_password, $real_name, $phone);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!');window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Registration failed, please try again!');window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>