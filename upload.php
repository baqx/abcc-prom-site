<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
$css1 = "upload.css";
include './header.php';
?>

<header class="upload-header">
    <h1>Upload Images</h1>
</header>

<main class="upload-content">
    <div id="upload-form">
        <form id="imageUploadForm" enctype="multipart/form-data">
            <div id="drop-area">
                <h3>Drag & Drop Images Here</h3>
                <p>or click to select files</p>
                <input type="file" id="fileInput" name="images[]" multiple>
            </div>
            <div id="file-list"></div>
            <textarea id="caption" name="caption" placeholder="Enter image caption (optional)" maxlength="200"></textarea>
            <button type="submit" class="upload-btn">Upload Images</button>
        </form>
    </div>
</main>

<div id="notification" class="notification"></div>
<div id="loading" class="loading-overlay">
    <div class="loading-spinner"></div>
</div>

<script src="./assets/js/upload.js"></script>
</body>

</html>