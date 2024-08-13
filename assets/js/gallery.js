function showPopup(imagePath, caption, uploadDate) {
  const popup = document.getElementById("popup");
  const popupImage = document.getElementById("popupImage");
  const popupCaption = document.getElementById("popupCaption");
  const popupDate = document.getElementById("popupDate");

  popupImage.src = imagePath;
  popupCaption.textContent = caption;
  popupDate.textContent = uploadDate;

  popup.style.display = "flex";
}

function closePopup() {
  const popup = document.getElementById("popup");
  popup.style.display = "none";
}

// Close popup when clicking outside of the image
document.getElementById("popup").addEventListener("click", function (e) {
  if (e.target === this) {
    closePopup();
  }
});

// Open upload modal (optional, implement the modal as per your design)
function openUploadModal() {
  // Your upload modal code
}
