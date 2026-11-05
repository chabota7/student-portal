// DOM Element Selections
const loginForm = document.getElementById('loginForm');
// Looks for 'username' first, but falls back to 'agentId' if that's what your HTML uses
const usernameInput = document.getElementById('username') || document.getElementById('agentId'); 
const passwordInput = document.getElementById('password');
const togglePassword = document.getElementById('togglePassword');
const forgotBtn = document.getElementById('forgotBtn');
const submitBtn = document.getElementById('submitBtn') || loginForm?.querySelector('button[type="submit"]');
const btnText = document.getElementById('btnText');
const spinner = document.getElementById('spinner');
const toast = document.getElementById('toast');

// Toggle Password Visibility
if (togglePassword && passwordInput) {
  togglePassword.addEventListener('click', () => {
    const currentType = passwordInput.getAttribute('type');
    const targetType = currentType === 'password' ? 'text' : 'password';
    
    passwordInput.setAttribute('type', targetType);
    togglePassword.classList.toggle('fa-eye');
    togglePassword.classList.toggle('fa-eye-slash');
  });
}

// Toast Helper Function
function showToast(message) {
  // Grab the element dynamically if the constant didn't catch it on load
  const toastElement = toast || document.getElementById('toast');
  if (!toastElement) return;
  
  toastElement.textContent = message;
  toastElement.classList.add('show');
  
  setTimeout(() => {
    toastElement.classList.remove('show');
  }, 3000);
}

// Forgot Password Click Event
if (forgotBtn) {
  forgotBtn.addEventListener('click', (e) => {
    e.preventDefault();
    showToast('Password reset link sent to registered email.');
  });
}

// Form Submission & Validation Logic
if (loginForm) {
  loginForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const username = usernameInput ? usernameInput.value.trim() : '';
    const password = passwordInput ? passwordInput.value.trim() : '';

    // Field Validations
    if (!username && !password) {
      showToast('Please enter both username and password.');
      usernameInput?.focus();
      return;
    }
    
    if (!username) {
      showToast('Please enter your username.');
      usernameInput?.focus();
      return;
    }
    
    if (!password) {
      showToast('Please enter your password.');
      passwordInput?.focus();
      return;
    }

    if (password.length < 6) {
      showToast('Password must be at least 6 characters.');
      passwordInput?.focus();
      return;
    }

    // Set Loading State (if you added these elements to your HTML)
    if (submitBtn) submitBtn.disabled = true;
    if (btnText) btnText.style.display = 'none';
    if (spinner) spinner.style.display = 'block';

    // Store session data so the dashboard knows the user is logged in
    sessionStorage.setItem('isLoggedIn', 'true');
    sessionStorage.setItem('agentId', username);

    // Success notification and redirect
    showToast("Login successful! Redirecting...");

    setTimeout(() => {
        window.location.href = "/student-portal/assets/php/portal.php"; 
    }, 1500);
  }); // Fixed missing closure here
}