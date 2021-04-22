const userButton = document.querySelector(".userButton");
const overlayContent = document.querySelector(".mainmenu-overlay-content");

const userButtonMobile = document.querySelector(".userButton-mobile");
const overlayContentMobile = document.querySelector(".mainmenu-overlay-content-mobile");

let opened = false;
let openedMobile = false


// for desktop
document.addEventListener("click", function (e) {
    if (e.target.className == "mainmenu-overlay-content" || e.target.parentElement.className == "mainmenu-overlay-content" || e.target.parentElement.parentElement.className == "mainmenu-overlay-content") {
        // do nothing
    } else {
        if (opened) {
            overlayContent.style.opacity = "0";
            overlayContent.style.pointerEvents = "none";
            opened = false;
        }
    }
});

userButton.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!opened) {
        overlayContent.style.opacity = "1";
        overlayContent.style.pointerEvents = "all";
        opened = true;
    } else {
        overlayContent.style.opacity = "0";
        overlayContent.style.pointerEvents = "none";
        opened = false;
    }
});

// for mobile
document.addEventListener("click", function (e) {
    if (e.target.className == "mainmenu-overlay-content-mobile" || e.target.parentElement.className == "mainmenu-overlay-content-mobile" || e.target.parentElement.parentElement.className == "mainmenu-overlay-content-mobile") {
        // do nothing
    } else {
        if (openedMobile) {
            overlayContent.style.display = "none";
            opened = false;
        }
    }
});

userButtonMobile.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!openedMobile) {
        overlayContentMobile.style.display = "flex";
        openedMobile = true;
    } else {
        overlayContentMobile.style.display = "none";
        openedMobile = false;
    }
});

