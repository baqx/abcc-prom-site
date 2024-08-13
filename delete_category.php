<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
if (!isset($_SESSION["myid"])) {
    header("location: ../login");
    exit();
}
if (getuser($_SESSION["myid"], "admin") < 1) {
    header("location : ../home");
    exit();
}
if (isset($_GET["cid"])) {
    $cid = $_GET["cid"];
}
$sql = mysqli_query($conn, "DELETE FROM vote_categories WHERE id=$cid");
$sql1 = mysqli_query($conn, "DELETE FROM nominees WHERE cid=$cid");
if ($sql && $sql1) {
    header("location: ../category?suc=del");
} else {
    header("location: ../category?err=del");
}
