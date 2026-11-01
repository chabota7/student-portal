// 1. Grab the form and the message area
const form = document.getElementById("registrationForm");
const message = document.getElementById("message");

// 2. Grab the inputs
const studentId = document.getElementById("studentId");
const firstName = document.getElementById("firstName");
const lastName = document.getElementById("lastName");
const email = document.getElementById("email");
const phone = document.getElementById("phone");
const programme = document.getElementById("programme");
const year = document.getElementById("year");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirmPassword");

function showError(fieldId, text) {
  const errorSpan = document.getElementById(fieldId + "Error");
  if (errorSpan) {
    errorSpan.textContent = text;
  }
}

// 3. Listen for submit event
if (form) {
  form.addEventListener("submit", function (event) {
    let isValid = true;

    // Clear old errors
    document.querySelectorAll(".right-panel span.text-danger").forEach(function (span) {
      span.textContent = "";
    });

    message.textContent = "";
    message.className = "mt-3 text-center fw-bold";

    // Student ID
    const idValue = studentId.value.trim();
    if (idValue === "") {
      showError("studentId", "Student ID is required");
      isValid = false;
    } else if (!/^\d+$/.test(idValue)) {
      showError("studentId", "Student ID must contain numbers only");
      isValid = false;
    } else if (idValue.length < 8 || idValue.length > 10) {
      showError("studentId", "Student ID must be 8 to 10 digits");
      isValid = false;
    }

    // Full Name
    // First Name
    const firstValue = firstName.value.trim();
    if (firstValue === "") {
      showError("firstName", "First name is required");
      isValid = false;
    } else if (firstValue.length < 2) {
      showError("firstName", "First name must have at least 2 characters");
      isValid = false;
    } else if (!/^[A-Za-z' -]+$/.test(firstValue)) {
      showError("firstName", "First name can only contain letters");
      isValid = false;
    }

    // Last Name
    const lastValue = lastName.value.trim();
    if (lastValue === "") {
      showError("lastName", "Last name is required");
      isValid = false;
    } else if (lastValue.length < 2) {
      showError("lastName", "Last name must have at least 2 characters");
      isValid = false;
    } else if (!/^[A-Za-z' -]+$/.test(lastValue)) {
      showError("lastName", "Last name can only contain letters");
      isValid = false;
    }
    // Email
    const emailValue = email.value.trim();
    if (emailValue === "") {
      showError("email", "Email is required");
      isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {
      showError("email", "Enter a valid email address");
      isValid = false;
    }

    // Phone
    const phoneValue = phone.value.trim();
    if (phoneValue === "") {
      showError("phone", "Phone number is required");
      isValid = false;
    } else if (!/^\d+$/.test(phoneValue)) {
      showError("phone", "Phone number must contain numbers only");
      isValid = false;
    } else if (phoneValue.length < 9 || phoneValue.length > 10) {
      showError("phone", "Phone number must be 9 to 10 digits");
      isValid = false;
    }

    // Programme
    if (programme.value === "") {
      showError("programme", "Please select a programme");
      isValid = false;
    }

    // Year of study
    if (year.value === "") {
      showError("year", "Please select your year of study");
      isValid = false;
    }

    // Password
    const passwordValue = password.value;
    if (passwordValue === "") {
      showError("password", "Password is required");
      isValid = false;
    } else if (passwordValue.length < 6) {
      showError("password", "Password must have at least 6 characters");
      isValid = false;
    } else if (!/\d/.test(passwordValue)) {
      showError("password", "Password must contain at least one number");
      isValid = false;
    }

    // Confirm password
    const confirmValue = confirmPassword.value;
    if (confirmValue === "") {
      showError("confirmPassword", "Please confirm your password");
      isValid = false;
    } else if (confirmValue !== passwordValue) {
      showError("confirmPassword", "Passwords do not match");
      isValid = false;
    }

    
      // Only stop the form if something is invalid
    if (!isValid) {
      event.preventDefault();
      message.classList.add("text-danger");
      message.textContent = "Please fix the errors above and try again";
    }
  });
}