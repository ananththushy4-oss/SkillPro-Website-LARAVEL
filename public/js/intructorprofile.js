const form = document.getElementById("profileForm");
const createBtn = document.getElementById("createBtn");
const updateBtn = document.getElementById("updateBtn");
const popup = document.getElementById("popupMessage");
const popupText = document.getElementById("popupText");
const profileImage = document.getElementById("profileImage");
const photoInput = document.getElementById("photo");
const inputs = form.querySelectorAll("input, textarea");

let profileCreated = false;
let originalData = {};

// Show popup
function showPopup(message) {
  popupText.textContent = message;
  popup.classList.add("active");
  setTimeout(() => {
    popup.classList.remove("active");
  }, 2000);
}


// Handle profile update
updateBtn.addEventListener("click", function () {
  if (profileCreated && !updateBtn.disabled) {
    showPopup("Profile updated successfully!");

    // Save latest data
    originalData = {};
    inputs.forEach(input => {
      originalData[input.id] = input.value;
    });

    updateBtn.disabled = true;

    // Update profile photo again
    profileImage.src = photoInput.value || "https://cdn-icons-png.flaticon.com/512/3135/3135715.png";
  }
});

// Enable update button when any change occurs
inputs.forEach(input => {
  input.addEventListener("input", () => {
    if (profileCreated) {
      let changed = false;
      inputs.forEach(inp => {
        if (inp.value !== originalData[inp.id]) {
          changed = true;
        }
      });
      updateBtn.disabled = !changed;
    }

    // Live preview for photo
    if (input.id === "photo") {
      profileImage.src = input.value.trim() || "https://cdn-icons-png.flaticon.com/512/3135/3135715.png";
    }
  });
});
