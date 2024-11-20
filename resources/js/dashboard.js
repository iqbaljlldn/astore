import "./bootstrap";

let today = new Date();

let now = today.toLocaleDateString("id-ID", {
    day: "2-digit",
    month: "long",
    year: "numeric",
});

let startDate = new Date(today.getFullYear(), today.getMonth(), 1)
let endDate = new Date(today.getFullYear(), today.getMonth() + 1, 1)

let startFormat = startDate.toLocaleDateString("id-ID", {
    day: "numeric",
    month: "short",
});

let endFormat = endDate.toLocaleDateString("id-ID", {
    day: "numeric",
    month: "short",
});

let range = `${startFormat} - ${endFormat}`

document.getElementById("today").innerText = now
document.getElementById("thisMonth").innerText = range

axios
    .get("api/sales-report")
    .then((response) => {
        let dailySales = response.data.data.sales.dailySales;
        let monthlyRevenue = response.data.data.sales.monthlyRevenue;
        document.getElementById("dailySales").innerText = dailySales;
        document.getElementById("monthlyRevenue").innerText = monthlyRevenue;
    })
    .catch((err) => {
        console.error("Error fetching API:", err.response || err);
    });

axios
    .get("api/top-seller")
    .then((response) => {
        console.log(response.data.data)
        let topSellers = response.data.data
        topSellers.forEach(element, index => {
            
        });
    })

    