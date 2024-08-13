document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);
    let xhr = new XMLHttpRequest();
    let loadingDiv = document.querySelector(".loading");
    let errorMessageDiv = document.getElementById("error-message");

    // Show the loading animation
    loadingDiv.style.display = "block";
    errorMessageDiv.style.display = "none"; // Hide any previous errors

    xhr.open("POST", "./inc/login_process.php", true);
    xhr.onload = function () {
      // Hide the loading animation
      loadingDiv.style.display = "none";

      if (xhr.status === 200) {
        let response = JSON.parse(xhr.responseText);
        if (response.status === "success") {
          window.location.href = "home.php"; // Redirect to homepage
        } else {
          errorMessageDiv.textContent = response.message;
          errorMessageDiv.style.display = "block";
        }
      } else {
        errorMessageDiv.textContent = "An error occurred. Please try again.";
        errorMessageDiv.style.display = "block";
      }
    };
    xhr.onerror = function () {
      // Hide the loading animation and show error message on failure
      loadingDiv.style.display = "none";
      errorMessageDiv.textContent =
        "An error occurred. Please check your connection and try again.";
      errorMessageDiv.style.display = "block";
    };
    xhr.send(formData);
  });
