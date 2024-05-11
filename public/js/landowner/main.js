const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

//DROPDOWN MENU
// Get the profile picture and dropdown content elements by ID
const profilePicture = document.getElementById('profilePicture');
const dropdownContent = document.getElementById('dropdownContent');

// Add an event listener to the profile picture
profilePicture.addEventListener('click', () => {
    // Toggle the visibility of the dropdown content when the profile picture is clicked
    if (dropdownContent.style.display === 'block') {
        dropdownContent.style.display = 'none';
    } else {
        dropdownContent.style.display = 'block';
    }
});

// Close the dropdown when clicking outside of it
document.addEventListener('click', (event) => {
    if (!event.target.closest('.profile-dropdown')) {
        dropdownContent.style.display = 'none';
    }
});

// Sample data for the chart
var productData = {
    labels: ["Product A", "Product B", "Product C"],
    datasets: [{
        label: 'Product Listings',
        data: [30, 20, 15],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
        ],
        borderWidth: 1
    }]
};













