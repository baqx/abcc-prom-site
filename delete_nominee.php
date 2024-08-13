<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
if(!isset($_SESSION["myid"])){
header("location: ../login");
exit();
}
if(getuser($_SESSION["myid"],"admin")<1){
    header("location : ../home");
exit();
}
if(isset($_GET["nid"])){
    $nid=$_GET["nid"];
}
$sql=mysqli_query($conn,"DELETE FROM nominees WHERE id=$nid");
if($sql){
    header("location: ../nominate?suc=del");
}else{
    header("location: ../nominate?err=del");
}