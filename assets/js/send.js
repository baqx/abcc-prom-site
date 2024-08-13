let canPost = true;

document.getElementById("anonymousMessageForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form from submitting normally

    if (!canPost) {
        showToast('Please wait 5 seconds before posting again.', 'error');
        return;
    }

    const message = document.getElementById("anonymousMessage").value;

    if (message.trim() === "") {
        showToast('Please fill in the input fields.', 'error');
        return;
    }

    const formData = new FormData();
    formData.append("msg", message);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./send.php", true);

    // Show loading spinner
    showLoadingSpinner();

    xhr.onload = function() {
        hideLoadingSpinner();
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                showToast(response.message, 'success');
                canPost = false;
                setTimeout(() => {
                    canPost = true;
                }, 5000); // Set the flood regulator for 5 seconds
                document.getElementById("anonymousMessageForm").reset();
                updateWordCount();
            } else {
                showToast(response.message, 'error');
            }
        } else {
            showToast('An error occurred while sending the message.', 'error');
        }
    };

    xhr.onerror = function() {
        hideLoadingSpinner();
        showToast('An error occurred while sending the message.', 'error');
    };

    xhr.send(formData);
});

function updateWordCount() {
  const message = document.getElementById("anonymousMessage").value;
  const wordCount = message.length;
  const wordCountDisplay = document.getElementById("wordCount");

  if (wordCount > 500) {
    wordCountDisplay.style.color = "red";
    wordCountDisplay.textContent = `${wordCount}/500 chars (Limit exceeded!)`;
  } else {
    wordCountDisplay.style.color = "";
    wordCountDisplay.textContent = `${wordCount}/500 chars`;
  }
}

function showToast(message, type) {
    // Create toast element
    const toast = document.createElement("div");
    toast.className = `toast ${type}`;
    toast.textContent = message;

    // Append toast to body
    document.body.appendChild(toast);

    // Remove toast after 3 seconds
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

function showLoadingSpinner() {
    // Show a loading spinner (you can customize this)
    const spinner = document.createElement("div");
    spinner.className = "spinner";
    document.body.appendChild(spinner);
}

function hideLoadingSpinner() {
    // Hide the loading spinner
    const spinner = document.querySelector(".spinner");
    if (spinner) spinner.remove();
}
