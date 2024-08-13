<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';

$response = ['success' => false, 'message' => ''];

if (!isset($_SESSION["myid"])) {
    $response['message'] = 'You must be logged in to vote.';
    echo json_encode($response);
    exit();
}

$myid = $_SESSION["myid"];
$nid = $_POST["nid"];
$timenow = time();

$query = mysqli_query($conn, "SELECT * FROM nominees WHERE id=$nid");
if ($row = mysqli_fetch_assoc($query)) {
    $nuid = $row["uid"];
    $cid = $row["cid"];

    $checkpoint = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM votes WHERE uid=$myid AND cid=$cid"));
    if ($checkpoint < 1) {
        $sql1 = mysqli_query($conn, "INSERT INTO votes(uid,nid,cid,timestamp) VALUES ($myid,$nid,$cid,$timenow)");
        $sql2 = mysqli_query($conn, "UPDATE nominees SET votes=votes+1 WHERE id=$nid");
        if ($sql1 && $sql2) {
            $response['success'] = true;
            $response['message'] = 'Vote successful!';
        } else {
            $response['message'] = 'Voting failed. Please try again.';
        }
    } else {
        $response['message'] = 'You have already voted in this category.';
    }
} else {
    $response['message'] = 'Invalid nominee.';
}

echo json_encode($response);
