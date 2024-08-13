<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';

if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 8;

$query = "SELECT img, caption, timestamp FROM memories LIMIT $offset, $limit";
$result = mysqli_query($conn, $query);

$images = [];
while ($row = mysqli_fetch_assoc($result)) {
    $images[] = $row;
}

echo json_encode(['images' => $images]);
mysqli_close($conn);
