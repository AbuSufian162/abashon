// HAMBURGER ANIMATION SELECTORS
const line1 = document.querySelector(".line1");
const line2 = document.querySelector(".line2");
const line3 = document.querySelector(".line3");
const lineArray = [line1, line2, line3];

// HAMBURGER CLICK EVENT
const hamburger = document.querySelector(".hamburger");
const menuOverlay = document.querySelector(".menu-overlay");

hamburger.addEventListener("click", () => {
  menuOverlay.classList.toggle("open");
  lineArray.forEach((item) => {
    item.classList.toggle("morph");
  });
});

// RETRACTING MENU ON NAV-LINK CLICK
document.querySelectorAll(".nav-links").forEach((item) => {
  item.addEventListener("click", () => {
    menuOverlay.classList.toggle("open");
    lineArray.forEach((item) => {
      item.classList.toggle("morph");
    });
  });
});

// TOGGLE MODAL ON CLICK
const filteradd=document.getElementById("filteradd");
const addfilter=document.getElementsById("addfilter");
filteradd.addEventListener("click", () => {
addfilter.style.opacity = "100";
addfilter.style.opacity = "flex";
filteradd.classList.toggle("addfilter");
//  togglediv.style.display= 'flex';
});
