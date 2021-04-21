// login page
const inputs = document.querySelectorAll(".inputClass");
const registerLinks = document.querySelectorAll(".register");
const screenPrava = document.querySelector(".screen-prava");
const screenLeva = document.querySelector(".screen-leva");
const clouds = document.querySelector(".mobile-clouds");

// Mainpage
const openMenuBtn = document.querySelector("#openMenuBtn");
const closeMenuBtn = document.querySelector("#closeMenuBtn");
const overlay =  document.querySelector(".overlay");
const blurBg = document.querySelector(".blur");
const mainPage = document.querySelector(".mainPage");

// login page input effects
/*
for (const input of inputs) {
    input.addEventListener("input", function() {
        if(input.value != "") {
            input.nextElementSibling.classList.add("offset");
        }
        else input.nextElementSibling.classList.remove("offset");
    });
}
*/
inputs.forEach((input) => {
    input.addEventListener("input", function() {
        if(input.value != "") {
            input.nextElementSibling.classList.add("offset");
        }
        else input.nextElementSibling.classList.remove("offset");
    });
});


registerLinks.forEach((registerLink) => {
    registerLink.addEventListener("click", function() {
        screenPrava.classList.toggle("switchRegistrationWhite");
        screenLeva.classList.toggle("switchRegistrationColor");
        clouds.classList.toggle("registerCloud");
    });
});
/*
for (const registerLink of registerLinks) {
    registerLink.addEventListener("click", function() {
        screenPrava.classList.toggle("switchRegistrationWhite");
        screenLeva.classList.toggle("switchRegistrationColor");
        clouds.classList.toggle("registerCloud");
    })
}*/

// Mainpage burger menu
openMenuBtn.addEventListener("click", function() {
    overlay.style.height = "45%";
    blurBg.style.height = "100%";
});
closeMenuBtn.addEventListener("click", function() {
    overlay.style.height = "0%";
    blurBg.style.height = "0%";
});
