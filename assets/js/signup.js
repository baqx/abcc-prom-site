document.addEventListener("DOMContentLoaded", function () {
  const signupForm = document.getElementById("signupForm");
  const loadingSpinner = document.getElementById("loadingSpinner");
  const imagePreview = document.getElementById("imagePreview");

  signupForm.addEventListener("submit", function (e) {
    e.preventDefault();
    loadingSpinner.style.display = "block";

    const formData = new FormData(signupForm);

    fetch("./inc/signup_process.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        loadingSpinner.style.display = "none";
        if (data.status === "success") {
          window.location.href = data.redirect;
        } else {
          displayErrors(data.message);
        }
      })
      .catch((error) => {
        loadingSpinner.style.display = "none";
        console.error("Error:", error);
      });
  });
});

function displayErrors(message) {
  const errorMessages = {
    username: document.getElementById("usernameError"),
    surname: document.getElementById("surnameError"),
    firstName: document.getElementById("firstNameError"),
    phoneNumber: document.getElementById("phoneNumberError"),
    class: document.getElementById("classError"),
    department: document.getElementById("departmentError"),
    password: document.getElementById("passwordError"),
    confirmPassword: document.getElementById("confirmPasswordError"),
    profilePicture: document.getElementById("profilePictureError"),
  };

  Object.keys(errorMessages).forEach((key) => {
    if (message.toLowerCase().includes(key.toLowerCase())) {
      errorMessages[key].innerText = message;
    } else {
      errorMessages[key].innerText = "";
    }
  });
}

function previewImage(event) {
  const reader = new FileReader();
  reader.onload = function () {
    const imagePreview = document.getElementById("imagePreview");
    imagePreview.src = reader.result;
    imagePreview.style.display = "block";
  };
  reader.readAsDataURL(event.target.files[0]);
}
