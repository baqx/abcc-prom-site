<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
$timenow = time();
if (!isset($_SESSION["myid"])) {
    header("location: ./login");
    exit();
}
$myid = $_SESSION["myid"];
if (!isset($_GET["nid"])) {
    header("location: ./voting");
    exit();
}
$nid = $_GET["nid"];
$query = mysqli_query($conn, "SELECT * FROM nominees WHERE id=$nid");
while ($row = mysqli_fetch_assoc($query)) {
    $nuid = $row["uid"];
    $cid = $row["cid"];
}
$checkpoint = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM votes WHERE uid=$myid AND nid=$nid"));
if ($checkpoint < 1) {
    //user has not voted
    $sql1 = mysqli_query($conn, "INSERT INTO votes(uid,nid,cid,timestamp) VALUES ($myid,$nid,$cid,$timenow)");
    $sql2 = mysqli_query($conn, "UPDATE nominees SET votes=votes+1 WHERE id=$nid");
    if ($sql1  && $sql2) {
        //successful voting
        header("location: ./voting?vote=success");
    }
} else {
    //user has voted already
    header("location: ./voting");
}
