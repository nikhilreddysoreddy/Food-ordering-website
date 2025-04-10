document.addEventListener("DOMContentLoaded", function() {
    fetchData("http://localhost:8080/api/orders/all", function(data) {
        let ordersList = document.getElementById("ordersList");
        data.forEach(order => {
            let li = document.createElement("li");
            li.textContent = `Order #${order.id} - ${order.status}`;
            ordersList.appendChild(li);
        });
    });
});