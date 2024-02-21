document.querySelector("input[name=search]").oninput = function () {
  let val = this.value.trim().toLowerCase();
  let itemproducts = document.querySelectorAll(".itemproduct");
  if (val != "") {
    itemproducts.forEach(function (elem) {
      if (elem.dataset.search.toLowerCase().search(val) == -1) {
        elem.classList.add("none");
      } else {
        elem.classList.remove("none");
      }
    });
  } else {
    itemproducts.forEach(function (elem) {
      elem.classList.remove("none");
    });
  }
};
