<?php
session_start();
if (isset($_SESSION['myid'])) {
    header('location: ./home');
    exit();
}
include './header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/config.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <style>
        .loading {
            display: none;
            text-align: center;
            margin-top: 10px;
        }

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-image">
            <img src="./assets/img/okayy.jpg" alt="Login Image">
        </div>
        <div class="login-form">
            <h2>Login to Your Account</h2>
            <div id="error-message" class="err"></div>
            <form id="loginForm">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <div class="error-message" id="usernameError"></div>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <div class="error-message" id="passwordError"></div>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <div class="loading">
                <div class="spinner"></div>
                <p>Checking your credentials...</p>
            </div>
        </div>
    </div>
    <script src="./assets/js/login.js"></script>
</body>

</html>