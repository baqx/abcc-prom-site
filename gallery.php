<?php
session_start();
include './inc/connect.php';
include './inc/functions.php';
$css1 = "gallery.css";
$exturl = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css";
include './header.php';
?>
<header class="gallery-header">
    <h1>Memories</h1>
    <a href="./upload" class="upload-btn">Upload Image</a>
</header>

<div class="gallery" id="gallery"></div>
<div class="loading-shimmer" id="loadingShimmer"></div>

<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <img id="popupImage" src="" alt="Full Size Image">
        <p id="popupCaption"></p>
        <p id="popupDate"></p>
    </div>
</div>

<script src="./assets/js/gallery.js"></script>
<script>
    // Load images on scroll
    let offset = 0;
    const limit = 8;

    function loadImages() {
        const loadingShimmer = document.getElementById('loadingShimmer');
        loadingShimmer.style.display = 'block';

        fetch(`fetch_images.php?offset=${offset}&limit=${limit}`)
            .then(response => response.json())
            .then(data => {
                loadingShimmer.style.display = 'none';
                const gallery = document.getElementById('gallery');
                data.images.forEach(image => {
                    const imgElement = document.createElement('div');
                    imgElement.classList.add('gallery-item');
                    imgElement.innerHTML = `
                            <img src="./assets/img/memories/${image.img}" alt="${image.caption}" onclick="showPopup('./assets/img/memories/${image.img}', '${image.caption}', '${image.timestamp}')">
                        `;
                    gallery.appendChild(imgElement);
                });
                offset += limit;
            })
            .catch(error => {
                console.error('Error loading images:', error);
                loadingShimmer.style.display = 'none';
            });
    }

    // Infinite scroll
    window.addEventListener('scroll', () => {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
            loadImages();
        }
    });

    loadImages(); // Initial load
</script>
</body>

</html>