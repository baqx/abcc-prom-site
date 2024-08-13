<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
if (!isset($_SESSION["myid"])) {
    header("location: ./login?ref=inner");
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
    if ($_POST["category"] !== "" && $_POST["student"] !== "") {

        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $student = mysqli_real_escape_string($conn, $_POST['student']);
        $checkstudent = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM nominees WHERE uid=$student AND cid=$category"));
        if ($checkstudent < 1) {
            $addquery = mysqli_query($conn, "INSERT INTO nominees (uid,cid) VALUES ('$student','$category')");
            if ($addquery) {
                $success_msg = "Nominee has been added successfully";
            } else {
                $error_msg = "Something went wrong";
            }
        } else {
            $error_msg = "The student has been added to the category already";
        }
    } else {
        $error_msg = "Please make sure you fill all fields";
    }
}
?>


<link rel="stylesheet" href="./assets/css/nominate.css">
<link rel="stylesheet" href="./assets/css/nominees_table.css">

<body>
    <section class="dashboard-content dashboard-section">
        <h2>Add Nominee</h2>
        <?php if ($error_msg) {
            echo "<span class='err'>$error_msg</span>";
        }
        if ($success_msg) {
            echo "<span class='suc'>$success_msg</span>";
        } ?>

        <form action="" method="post">
            <div class="add-nominee">
                <div class="form-group">
                    <label for="category-select">Select Category</label>
                    <select id="category-select" name="category">
                        <option value="">Select a category</option>
                        <?php
                        $cats = mysqli_query($conn, "SELECT * FROM vote_categories ORDER BY id DESC");
                        while ($cat = mysqli_fetch_assoc($cats)) {
                            $catid = $cat["id"];
                            $catname = $cat["name"];
                            echo "<option value='$catid'>$catname</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="student-select">Select Student</label>
                    <select id="student-select" name="student">
                        <option value="">Select a student</option>
                        <?php
                        $students = mysqli_query($conn, "SELECT * FROM users ORDER BY surname ASC");
                        while ($student = mysqli_fetch_assoc($students)) {
                            $sid = $student["id"];
                            $studentname = "" . $student["surname"] . " " . $student["firstname"] . "";
                            echo "<option value='$sid'>$studentname</option>";
                        }
                        ?>

                    </select>
                </div>
                <input type="submit" id="add-nominee-button" class="btn" value="Add Nominee" />
            </div>
        </form>

        <body>
            <section class="table-section">
                <h2>Nominees List</h2>
                <div class="table-container">
                    <table class="nominees-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Votes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM nominees ORDER BY cid ");
                            while ($row = mysqli_fetch_assoc($sql)) {
                                $uid = $row["uid"];
                                $votes = $row["votes"];
                                $name = "" . getuser($uid, "surname") . " " . getuser($uid, "firstname") . "";
                                $category = getcat($row["cid"]);
                                $nid = $row["id"];
                                echo "
 <tr>
                                <td>$name</td>
                                <td>$category</td>
                                <td>$votes</td>
                                <td><a href='./delnominee/$nid' style='text-decoration:none !important;color:white;'><button class='delete-btn'>Delete</button></a></td>
                            </tr>
                                ";
                                if (mysqli_num_rows($sql) < 1) {

                                    echo "<div style='margin:10px;'><center> There are no nominees available </center></div>";
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </section>


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
</body>
<?php include './footer.php'; ?>