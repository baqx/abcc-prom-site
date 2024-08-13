<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
if (!isset($_SESSION["myid"])) {
    header("location: ./login?ref=inner");
    exit();
}

include './dashboard_header.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Voting</title>
    <link rel="stylesheet" href="./assets/css/config.css">
    <link rel="stylesheet" href="./assets/css/voting.css">
</head>

<body>
    <section class="voting-section">
        <div class="section-header">
            <h2>Vote for Your Favorites</h2>
        </div>
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM vote_categories ORDER BY name DESC");
        while ($row = mysqli_fetch_array($sql)) {
            $catname = $row["name"];
            $catid = $row["id"];
        ?>
            <div class="category" id="category-<?php echo $catid; ?>">
                <h3><?php echo $catname; ?></h3>
                <div class="nominees">
                    <?php
                    $sql2 = mysqli_query($conn, "SELECT * FROM nominees WHERE cid=$catid");
                    while ($row2 = mysqli_fetch_array($sql2)) {
                        $uid = $row2["uid"];
                        $nid = $row2["id"];
                        $avatar = getuser($uid, "avatar");
                        $name = "" . getuser($uid, "surname") . " " . getuser($uid, "firstname") . "";
                        echo "
            <div class='nominee'>
                <img src='./assets/img/avatars/$avatar' alt='$name nominee'>
                <p>$name</p>
                ";
                        $checkme = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM votes WHERE uid=$myid AND cid=$catid"));
                        if ($checkme < 1) {
                            echo "  <button class='vote-btn' onclick='vote($nid, $catid, this)'>Vote</button>";
                        } else {
                            echo "<span style='color:var( --secondary-text-color) !important;'>You have voted this category</span>";
                        }
                        echo "   
            </div>";
                    }
                    ?>
                </div>
            </div>

            </div>
        <?php } ?>
    </section>

    <script src="./assets/js/voting.js"></script>
</body>

</html>