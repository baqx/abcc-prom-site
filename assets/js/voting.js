function vote(nid, catid, btn) {
  btn.disabled = true; // Disable the clicked button
  const originalText = btn.innerText;
  btn.innerHTML = '<div class="spinner"></div>'; // Show loading spinner

  fetch("./ajax_vote.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `nid=${nid}`,
  })
    .then((response) => response.json())
    .then((data) => {
      btn.innerHTML = originalText; // Reset button text
      if (data.success) {
        disableCategoryButtons(catid);
        btn.innerText = "Voted";
        const votedMsg = document.createElement("p");
        votedMsg.classList.add("voted-msg");
        votedMsg.innerText = "Your vote has been added successfully";
        btn.parentElement.appendChild(votedMsg); // Display voted message
      } else {
        btn.disabled = false; // Re-enable the button if voting failed
      }
      showToast(data.message, data.success ? "success" : "error"); // Show feedback
    })
    .catch((error) => {
      console.error("Error:", error);
      btn.disabled = false;
      btn.innerHTML = originalText;
      showToast("An error occurred. Please try again.", "error");
    });
}

function disableCategoryButtons(catid) {
  const category = document.getElementById(`category-${catid}`);
  const buttons = category.querySelectorAll(".vote-btn");
  buttons.forEach((button) => {
    button.disabled = true;
    button.innerText = "Voted";
  });
}

function showToast(message, type) {
  const toast = document.createElement("div");
  toast.classList.add("toast", type);
  toast.innerText = message;
  document.body.appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, 3000);
}
