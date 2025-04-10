// script.js - Common JavaScript functions

document.addEventListener("DOMContentLoaded", function() {
    console.log("Frontend loaded successfully");
});

function fetchData(url, callback) {
    fetch(url)
        .then(response => response.json())
        .then(data => callback(data))
        .catch(error => console.error("Error fetching data:", error));
}

function postData(url, data, callback) {
    fetch(url, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => callback(data))
    .catch(error => console.error("Error posting data:", error));
}