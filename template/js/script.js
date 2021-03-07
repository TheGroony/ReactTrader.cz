const inputs = document.querySelectorAll(".inputClass");
const registerLinks = document.querySelectorAll(".register");
const screenPrava = document.querySelector(".screen-prava");
const screenLeva = document.querySelector(".screen-leva");
const clouds = document.querySelector(".mobile-clouds");

for (const input of inputs) {
    input.addEventListener("input", function() {
        if(input.value != "") {
            input.nextElementSibling.classList.add("offset");
        }
        else input.nextElementSibling.classList.remove("offset");
    });
}

for (const registerLink of registerLinks) {
    registerLink.addEventListener("click", function() {
        screenPrava.classList.toggle("switchRegistrationWhite");
        screenLeva.classList.toggle("switchRegistrationColor");
        clouds.classList.toggle("registerCloud");
    })
}

