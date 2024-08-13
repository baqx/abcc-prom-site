<?php
session_start();
include './connect.php';
include './functions.php';

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $username = strtolower(mysqli_real_escape_string($conn, $username));

        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['myid'] = $user['id'];
                setcookie("username", $user['username'], time() + (60 * 60 * 24 * 30));
                setcookie("sess", $user['password'], time() + (60 * 60 * 24 * 30));
                $response['status'] = 'success';
                $response['message'] = 'Login successful';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Incorrect password. Please try again.';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Username not found. Please check your username and try again.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Both fields are required.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
