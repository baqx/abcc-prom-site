<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
if (!isset($_SESSION["myid"])) {
    header("location: ./login/?ref=inner");
    exit();
}
if (getuser($_SESSION["myid"], "admin") < 1) {
    header("location: ./home");
    exit();
}
include './dashboard_header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error_msg = "";
    $success_msg = "";
    if ($_POST["category"] !== "") {

        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $addquery = mysqli_query($conn, "INSERT INTO vote_categories (name) VALUES ('$category')");
        if ($addquery) {
            $success_msg = "Category has been added successfully";
        } else {
            $error_msg = "Something went wrong";
        }
    } else {
        $error_msg = "Please enter a category";
    }
}
?>


<link rel="stylesheet" href="./assets/css/nominate.css">
<section class="dashboard-content dashboard-section">
    <h2>Register Voting Category</h2>
    <?php if ($error_msg) {
        echo "<span class='err'>$error_msg</span>";
    }
    if ($success_msg) {
        echo "<span class='suc'>$success_msg</span>";
    } ?>
    <div class="add-nominee">
        <form action="" method="post">
            <div class="form-group">
                <label for="category-select">Category</label>
                <input id="category-select" class="finput" type="text" name="category" placeholder="e.g Best Dressed Male" autocomplete="off" required />

            </div>

            <input type="submit" class="btn" id="add-nominee-button" value="Add Category">
        </form>

    </div>

    <div class="view-categories">
        <h3>Categories</h3>
        <ul id="category-list">
            <?php
            $fetchcat = mysqli_query($conn, "SELECT * FROM vote_categories ORDER BY id DESC");
            // Check if there are any categories
            if (mysqli_num_rows($fetchcat) > 0) {
                // Fetch and display each category
                while ($row = mysqli_fetch_assoc($fetchcat)) {
                    $catname = htmlspecialchars($row["name"]); // Use htmlspecialchars to prevent XSS
                    $catid = (int) $row["id"]; // Cast to int for safety
                    $fn = mysqli_query($conn, "SELECT * FROM nominees WHERE cid=$catid ORDER BY votes DESC limit 1");
                    if (mysqli_num_rows($fn) > 0) {
                        while ($fnr = mysqli_fetch_assoc($fn)) {
                            $fnuser = "" . getuser($fnr["uid"], "surname") . " " . getuser($fnr["uid"], "firstname") . "";
                        }
                    } else {
                        $fnuser = "no votes";
                    }
                    echo "
                <li>
                    $catname ($fnuser)
                   <a href='./delcat/$catid'><button class='delete-category-button'>Delete</button></a>
                </li>
                ";
                }
            } else {
                // Display message when no categories are found
                echo "<div style='margin:10px;'><center> There are no categories available </center></div>";
            }
            ?>
        </ul>
    </div>
</section>