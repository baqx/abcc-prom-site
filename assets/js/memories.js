const images = document.querySelectorAll(".marquee img");
const modal = document.getElementById("photoPreviewModal");
const previewImage = document.getElementById("previewImage");

images.forEach((img) => {
  img.addEventListener("click", () => {
    previewImage.src = img.src; // Set the preview image source
    modal.classList.add("show"); // Show the modal
    previewImage.classList.remove("scale-down"); // Remove scale-down class if it was previously applied
    setTimeout(() => {
      previewImage.classList.add("scale-up"); // Add scale-up class to animate
    }, 10); // Small timeout to allow CSS transition
  });
});

function closeModal() {
  previewImage.classList.remove("scale-up"); // Remove scale-up class to animate down
  setTimeout(() => {
    modal.classList.remove("show"); // Hide the modal after the transition
  }, 300); // Match with the transition duration
}
