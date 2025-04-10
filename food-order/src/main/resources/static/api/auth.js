document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");

    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            event.preventDefault();
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            login(username, password);
        });
    }

    if (signupForm) {
        signupForm.addEventListener("submit", function(event) {
            event.preventDefault();
            const newUsername = document.getElementById("newUsername").value;
            const newPassword = document.getElementById("newPassword").value;
            signup(newUsername, newPassword);
        });
    }
});

function login(username, password) {
    fetch("http://localhost:8080/api/auth/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.text())
    .then(token => {
        localStorage.setItem("jwtToken", token);
        window.location.href = "dashboard.html";
    })
    .catch(error => console.error("Error during login:", error));
}

function signup(username, password) {
    fetch("http://localhost:8080/api/auth/signup", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.text())
    .then(message => {
        alert(message);
        window.location.href = "login.html";
    })
    .catch(error => console.error("Error during signup:", error));
}