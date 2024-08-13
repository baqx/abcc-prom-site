<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
$myid = $_SESSION["myid"];
$targetDir = "assets/img/memories/";
$response = ['success' => false, 'errors' => []];

$allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];

// Check if files are uploaded
if (!empty($_FILES['images']['name'][0])) {
    $caption = isset($_POST['caption']) ? mysqli_real_escape_string($conn, $_POST['caption']) : '';


    if (!$conn) {
        $response['error'] = 'Failed to connect to the database.';
        echo json_encode($response);
        exit();
    }

    foreach ($_FILES['images']['name'] as $key => $name) {
        $imageFileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $unq = uniqid();
        $newFileName = $targetDir . $unq . '.' . $imageFileType;
        $fname = "$unq.$imageFileType";
        if (in_array($imageFileType, $allowedFileTypes)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $newFileName)) {
                // Insert image info into the database
                $timenow = time();
                $query = "INSERT INTO memories(uid,img,caption,timestamp) VALUES ($myid,'$fname', '$caption','$timenow')";
                if (!mysqli_query($conn, $query)) {
                    $response['errors'][] = "Database error: Failed to save $name.";
                }
            } else {
                $response['errors'][] = "Failed to move $name to the target directory.";
            }
        } else {
            $response['errors'][] = "$name is not a valid image file.";
        }
    }

    if (empty($response['errors'])) {
        $response['success'] = true;
    }

    mysqli_close($conn);
} else {
    $response['error'] = 'No files were uploaded.';
}

echo json_encode($response);
