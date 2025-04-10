document.addEventListener("DOMContentLoaded", function() {
    const logoutButton = document.getElementById("logoutButton");
    if (logoutButton) {
        logoutButton.addEventListener("click", function() {
            localStorage.removeItem("jwtToken"); // Remove stored token
            window.location.href = "login.html"; // Redirect to login page
        });
    }
});