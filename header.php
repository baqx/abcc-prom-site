<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/config.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/timeline.css">
    <link rel="stylesheet" href="./assets/css/memories.css">
    <link rel="stylesheet" href="./assets/css/countdown.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
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
    <title>ABCC 2K24 farewell bash</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <?php if (isset($js1)) {
        echo "<script src='./assets/js/$js1' defer></script>";
    } ?>
</head>
<header>
    <nav>
        <a style="text-decoration: none;" href="./">
            <h1>ABCC Farewell bash 2024</h1>
        </a>
        <ul>
            <li><a href="./voting">Voting</a></li>
            <li><a href="./gallery">Gallery</a></li>
            <?php if (isset($_SESSION["myid"])) { ?>
                <li><a href="./home">Dashboard</a></li>

            <?php } else { ?>
                <li><a href="./login">Login</a></li>
            <?php
            } ?>

        </ul>
    </nav>
</header>

<body>