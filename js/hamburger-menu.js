const navbarLinks = document.getElementsByClassName("navbar__links");

function openHamburgerMenu() {
  console.log("Funcionou");
  document.querySelector(".navbar__links").classList.toggle("open");
}
