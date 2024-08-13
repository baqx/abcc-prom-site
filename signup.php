<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
$pname = "Signup";
if (isset($_SESSION['myid'])) {
    header('location: ./home.php');
    exit();
}
$myip = getip();

function generateUniqueFileName($filename)
{
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    return $basename . "_" . uniqid() . "." . $ext;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error_msg = "";
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

    if ($_POST['username'] != "" && $_POST['password'] != "" && $_POST['confirmPassword'] != "" && $_POST['phoneNumber'] != "" && $_POST['class'] != "" && $_POST['firstName'] != "" && $_POST['surname'] != "" && $_POST['department'] != "") {
        if (!preg_match('/\s/', trim($_POST['username']))) {
            if (!preg_match('/[^a-z0-9_]/i', trim($_POST['username']))) {
                $username = strtolower(trim($_POST['username']));
                $query = mysqli_query(
                    $conn,
                    "SELECT username FROM users WHERE username='$username'"
                );

                if ($_POST["password"] == $_POST["confirmPassword"]) {
                    if (!(mysqli_num_rows($query) >= 1)) {
                        // Handle the image upload
                        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == UPLOAD_ERR_OK) {
                            $file_tmp = $_FILES['profilePicture']['tmp_name'];
                            $file_name = $_FILES['profilePicture']['name'];
                            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                            if (in_array($file_ext, $allowed_extensions)) {
                                $avatar = generateUniqueFileName($file_name);
                                $upload_dir = './assets/img/avatars/';
                                if (!is_dir($upload_dir)) {
                                    mkdir($upload_dir, 0777, true);
                                }
                                $upload_file = $upload_dir . $avatar;

                                if (move_uploaded_file($file_tmp, $upload_file)) {
                                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
                                    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
                                    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
                                    $class = mysqli_real_escape_string($conn, $_POST['class']);
                                    $department = mysqli_real_escape_string($conn, $_POST['department']);
                                    $timenow = time(); // Assuming $timenow is a timestamp
                                    $sql = "INSERT INTO users(username, password, logged, created, ip, surname, firstname, phone, class, department, avatar)
                                            VALUES ('$username', '$password', '$timenow', '$timenow','$myip','$surname','$firstName','$phoneNumber','$class','$department','$avatar')";

                                    if (mysqli_query($conn, $sql)) {
                                        $last_id = mysqli_insert_id($conn);
                                        $_SESSION['myid'] = $last_id;
                                        setcookie("username", $_POST['username'], time() + (60 * 60 * 24 * 30));
                                        setcookie("sess", $password, time() + (60 * 60 * 24 * 30));
                                        header('location: ./home?signup=success');
                                        exit();
                                    } else {
                                        $error_msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }
                                } else {
                                    $error_msg = "Failed to upload image. Please try again.";
                                }
                            } else {
                                $error_msg = "Only JPG, JPEG, PNG, and GIF files are allowed.";
                            }
                        } else {
                            $error_msg = "Please upload a valid image file.";
                        }
                    } else {
                        $error_msg = "This username already exists.";
                    }
                } else {
                    $error_msg = "Passwords do not match. Please make sure they are the same.";
                }
            } else {
                $error_msg = "Username can only contain letters, numbers, and underscores.";
            }
        } else {
            $error_msg = "Username cannot contain whitespace.";
        }
    } else {
        $error_msg = "All fields, including profile picture, must be filled out.";
    }
}
$css1 = "signup.css";
$js1 = "signup.js";
include './header.php';
?>
<div class="signup-container">
    <div class="signup-image">
        <img src="./assets/img/sofiat-meme.jpg" alt="Sign up image">
    </div>
    <form action="" method="post" class="signup-form" enctype="multipart/form-data">
        <div class="section-header">
            <h2>Sign Up</h2>
        </div>
        <?php if ($error_msg) {
            echo "<span class='err'>$error_msg</span>";
        } ?>
        <div class="form-group">
            <label for="profilePicture">Profile Picture</label>
            <input type="file" id="profilePicture" name="profilePicture" accept="image/*" required onchange="previewImage(event)">
            <img id="imagePreview" class="image-preview" src="#" alt="Image Preview" style="display: none;">
            <span class="error-message" id="profilePictureError"></span>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <span class="error-message" id="usernameError"></span>
        </div>

        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" id="surname" name="surname" required>
            <span class="error-message" id="surnameError"></span>
        </div>

        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" required>
            <span class="error-message" id="firstNameError"></span>
        </div>

        <div class="form-group">
            <label for="phoneNumber">Phone Number</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>
            <span class="error-message" id="phoneNumberError"></span>
        </div>

        <div class="form-group">
            <label for="class">Class</label>
            <select id="class" name="class" required>
                <option value="">Select Class</option>
                <option value="SSA">SS A</option>
                <option value="SSB1">SS B1</option>
                <option value="SSB2">SS B2</option>
                <option value="SSC">SS C</option>
                <option value="SSD">SS D</option>
            </select>
            <span class="error-message" id="classError"></span>
        </div>

        <div class="form-group">
            <label for="department">Department</label>
            <select id="department" name="department" required>
                <option value="">Select Department</option>
                <option value="art">Art</option>
                <option value="commercial">Commercial</option>
                <option value="science">Science</option>
            </select>
            <span class="error-message" id="departmentError"></span>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <span class="error-message" id="passwordError"></span>
        </div>

        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <span class="error-message" id="confirmPasswordError"></span>
        </div>

        <input type="submit" class="submit-btn" value="Sign Up" />
    </form>
</div>
</body>

</html>