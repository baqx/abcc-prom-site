<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include './inc/connect.php';
include './inc/functions.php';
if (!isset($_GET["id"])) {
    header("location: ./anonymous");
    exit();
}
$mid = (int)$_GET["id"];
$sql = mysqli_query($conn, "SELECT * FROM messages WHERE id=$mid");
while ($row = mysqli_fetch_assoc($sql)) {
    $msg = msg_decrypt($row["content"]);
    $timestamp = $row["timestamp"];
    $formattedDate = date('g:i A, M j, Y', $timestamp);
}
// Function to wrap text to a specific number of words per line
function wordWrapCustom($text, $wordsPerLine)
{
    $words = explode(' ', $text);
    $lines = array_chunk($words, $wordsPerLine);
    return implode("\n", array_map('implode', array_map(function ($line) {
        return array_fill(0, 1, implode(' ', $line));
    }, $lines)));
}

// Function to calculate the height needed for the text
function calculateTextHeight($fontPath, $fontSize, $text, $maxWidth)
{
    $lines = explode("\n", $text);
    $totalHeight = 0;
    foreach ($lines as $line) {
        $bbox = imagettfbbox($fontSize, 0, $fontPath, $line);
        $lineHeight = abs($bbox[7] - $bbox[1]);
        $totalHeight += $lineHeight;
    }
    return $totalHeight + 10; // Adding padding
}

// Create a blank image
$width = 600; // Base width, will be adjusted based on content
$fontPath = './Inter.ttf'; // Path to the font
$headerfontPath = './Merriweather.ttf';
$fontSizeHeader = 17; // Font size for header
$fontSizeText = 13; // Font size for paragraph
$fontSizeTime = 11; // Font size for timestamp

// Text content
$header = "Whispers of ABCC #2K24";
$text = $msg;
$time = "Submitted: $formattedDate";

// Wrap text to 10 words per line
$wrappedHeader = wordWrapCustom($header, 5);
$wrappedText = wordWrapCustom($text, 10);

// Calculate the image dimensions based on wrapped text
$textWidth = $width - 30; // Padding left and right
$headerHeight = calculateTextHeight($fontPath, $fontSizeHeader, $wrappedHeader, $textWidth) + 10;
if (strlen($msg) > 100) {
    $textHeight = calculateTextHeight($fontPath, $fontSizeText, $wrappedText, $textWidth) + 50;
} else {
    $textHeight = calculateTextHeight($fontPath, $fontSizeText, $wrappedText, $textWidth);
}

$timeHeight = calculateTextHeight($fontPath, $fontSizeTime, $time, $textWidth) + 10;
$imageHeight = $headerHeight + $textHeight + $timeHeight + 150; // Add padding and spacing

$image = imagecreatetruecolor($width, $imageHeight);

// Allocate colors
$backgroundColor = imagecolorallocate($image, 18, 18, 18); // #121212
$textColor = imagecolorallocate($image, 255, 255, 255); // White
$timeColor = imagecolorallocate($image, 220, 20, 124); // #dc147c

// Fill the background
imagefilledrectangle($image, 0, 0, $width, $imageHeight, $backgroundColor);

// Draw the header
$headerX = 15;
$headerY = 30;
imagettftext($image, $fontSizeHeader, 0, $headerX, $headerY, $textColor, $headerfontPath, $wrappedHeader);

// Draw the paragraph text
$textX = 15;
$textY = $headerY + $headerHeight + 10;
imagettftext($image, $fontSizeText, 0, $textX, $textY, $textColor, $fontPath, $wrappedText);

// Draw the timestamp
$timeX = 15;
$timeY = $textY + $textHeight + 17;
imagettftext($image, $fontSizeTime, 0, $timeX, $timeY, $timeColor, $fontPath, $time);
$rand = rand(0, 10000);
// Set the content type
header('Content-Type: image/png');
header("Content-Disposition: attachment; filename=ABCC_2K24_whisper_$rand.png");

// Output the image
imagepng($image);

// Free memory
imagedestroy($image);
