document.addEventListener("DOMContentLoaded", function() {
    fetchData("http://localhost:8080/api/categories/all", function(data) {
        let categoriesList = document.getElementById("categoriesList");
        data.forEach(category => {
            let li = document.createElement("li");
            li.textContent = category.name;
            categoriesList.appendChild(li);
        });
    });
});