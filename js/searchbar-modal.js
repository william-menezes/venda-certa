const searchbar = document.getElementById("searchbar");

function modalSearchbar() {
  searchbar.style.display = "block";
}

window.onclick = function (event) {
  if (event.target == searchbar) {
    searchbar.style.display = "none";
  }
};
