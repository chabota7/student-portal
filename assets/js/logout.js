// DOM Element Selections
const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
const btnText = document.getElementById('btnText');
const spinner = document.getElementById('spinner');
const confirmSection = document.getElementById('confirmSection');
const loggedOutSection = document.getElementById('loggedOutSection');

if (confirmLogoutBtn) {
  confirmLogoutBtn.addEventListener('click', () => {
    // Disable Button & Show Spinner
    confirmLogoutBtn.disabled = true;
    if (btnText) btnText.style.display = 'none';
    if (spinner) spinner.style.display = 'block';

    // Clear session storage / local tokens if any exist
    localStorage.removeItem('userToken');
    sessionStorage.clear();

    // Simulate logout delay then redirect
    setTimeout(() => {
      if (confirmSection) confirmSection.style.display = 'none';
      if (loggedOutSection) loggedOutSection.style.display = 'block';

     // Auto-redirect to login page after 1.5s
      // Auto-redirect to the PHP script to destroy the session
    setTimeout(() => {
      window.location.href = '/student-portal/assets/php/logout.php?action=confirm';
    }, 1500);
    }, 1000);
  });
}