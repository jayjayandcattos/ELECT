function animateBoxes() {
  const box1 = document.querySelector(".box1");
  const box2 = document.querySelector(".box2");
  const fadeInSection = document.getElementById("fadeInSection");
  box1.style.transform = "translateX(200vw)";
  box2.style.transform = "translateX(-90vw)";
  setTimeout(() => {
    fadeInSection.classList.add("visible");
  }, 1000);
}
document
  .getElementById("animateButton")
  .addEventListener("click", animateBoxes);
