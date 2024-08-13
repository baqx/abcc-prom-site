<?php

/** 
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  
 **/



$myid = $_SESSION["myid"];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE id=$myid");
while ($row = mysqli_fetch_assoc($sql)) {
    $myusername = $row["username"];
    $myclass = $row["class"];
    $mysurname = $row["surname"];
    $myfirstname = $row["firstname"];
    $myphonenumber = $row["phone"];
    $myavatar = $row["avatar"];
    $mydepartment = ucfirst($row["department"]);
    $myadminstatus = $row["admin"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $theme = "light";
    if (isset($css1)) {
        echo "<link rel='stylesheet' href='$site_path/assets/css/";
        if ($theme != "light") {
            echo "dark/";
        }
        echo "" . $css1 . "'>";
    } ?> <?php if (isset($css2)) {
            echo "<link rel='stylesheet' href='$site_path/assets/css/";
            if ($theme != "light") {
                echo "dark/";
            }
            echo "" . $css2 . "'>";
        } ?> <?php if (isset($exturl)) {
                    echo "<link rel='stylesheet' href='" . $exturl . "'>";
                } ?> <?php if (isset($css3)) {
                            echo "<link rel='stylesheet' href='$site_path/assets/css/";
                            if ($theme != "light") {
                                echo "dark/";
                            }
                            echo "" . $css3 . "'>";
                        } ?> <?php if (isset($css4)) {
                                    echo "<link rel='stylesheet' href='$site_path/assets/css/";
                                    if ($theme != "light") {
                                        echo "dark/";
                                    }
                                    echo "" . $css4 . "'>";
                                } ?>
    <link rel="stylesheet" href="./assets/css/config.css">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/css/countdown.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php if ($pname != "") {
                echo "$pname";
            } else {
                echo $site_name;
            } ?></title>
    <meta name="description" content="<?php echo $site_tagline; ?>">
    <script src="./assets/js/home.js"></script>
</head>

<body>
    <header class="dashboard-header">
        <h3>ABCC Farewell Bash Dashboard</h3>
        <div class="hamburger" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </div>
    </header>

    <nav class="sidebar" id="sidebar">
        <div class="close-btn" onclick="toggleSidebar()">
            &times;
        </div>
        <ul>
            <li><a href="./">Home</a></li>
            <li><a href="./home">Dashboard</a></li>
            <li><a href="./send">Anonymous Messaging</a></li>
            <li><a href="./voting">Voting</a></li>
            <li><a href="./messages">My Anonymous Messages</a></li>
            <?php if ($myadminstatus > 0) {  ?>

                <li><a href="./category">Add Voting Category</a></li>
                <li><a href="./nominate">Add Voting Nominee</a></li>

            <?php } ?>

            <li><a href="./logout">Logout</a></li>
        </ul>
    </nav>