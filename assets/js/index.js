var header = document.getElementById("navbar");

if (header) {
  var btns = header.getElementsByClassName("nav-item");

  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function () {
      var current = document.getElementsByClassName("active");
      if (current.length > 0) {
        current[0].classList.remove("active");
      }
      this.classList.add("active");
    });
  }
}
