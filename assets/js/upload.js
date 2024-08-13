document.addEventListener('DOMContentLoaded', () => {
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('file-list');
    const uploadForm = document.getElementById('imageUploadForm');
    const notification = document.getElementById('notification');
    const loading = document.getElementById('loading');

    dropArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropArea.classList.add('dragging');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('dragging');
    });

    dropArea.addEventListener('drop', (event) => {
        event.preventDefault();
        dropArea.classList.remove('dragging');
        handleFiles(event.dataTransfer.files);
    });

    dropArea.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', (event) => {
        handleFiles(event.target.files);
    });

    uploadForm.addEventListener('submit', (event) => {
        event.preventDefault();
        uploadFiles(new FormData(uploadForm));
    });

    function handleFiles(files) {
        fileList.innerHTML = '';
        Array.from(files).forEach(file => {
            const listItem = document.createElement('p');
            listItem.textContent = file.name;
            fileList.appendChild(listItem);
        });
    }

    function uploadFiles(formData) {
        loading.style.display = 'flex';

        fetch('./gallery-upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            loading.style.display = 'none';
            if (data.success) {
                showNotification('Images uploaded successfully!', 'success');
            } else {
                showNotification(data.error || 'Failed to upload images.', 'error');
            }
            fileList.innerHTML = '';
        })
        .catch(() => {
            loading.style.display = 'none';
            showNotification('An error occurred during upload.', 'error');
        });
    }

    function showNotification(message, type) {
        notification.textContent = message;
        notification.className = `notification ${type}`;
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                notification.style.display = 'none';
                notification.style.opacity = '1';
            }, 500);
        }, 3000);
    }
});
