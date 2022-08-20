const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const navLink = document.querySelectorAll(".nav-link");
//The Document method querySelector() returns 
//the first Element within the document that matches the specified selector, 
//or group of selectors. If no matches are found, null is returned.

hamburger.addEventListener("click", mobileMenu);
navLink.forEach(n => n.addEventListener("click", closeMenu));
//The addEventListener() method of the EventTarget interface sets up a function 
//that will be called whenever the specified event is delivered to the target.


//When the hamburger is clicked in minimized screen the below activates it. 
function mobileMenu() {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
}

// function closeMenu() {
//     hamburger.classList.remove("active");
//     navMenu.classList.remove("active");
// }