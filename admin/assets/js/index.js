let img = document.querySelector(".foto-add .img img");
let file = document.querySelector(".file");
file.onchange = function (event) {
  let target = event.target;
  let fileReader = new FileReader();
  fileReader.onload = function () {
    img.src = fileReader.result;
  };
  fileReader.readAsDataURL(target.files[0]);
};
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("input[type=text]").forEach((elem) => {
    elem.value = "";
  });
  document.querySelectorAll("input[type=file]").forEach((elem) => {
    elem.value = "";
  });
});
async function addproduct() {
  let title = document.querySelector("input[name=title]").value;
  let price = document.querySelector("input[name=price]").value;
  let category = document.querySelector("select[name=category]").value;
  let quantity = document.querySelector("input[name=quantity]").value;
  let foto = document.querySelector("input[name=foto]").files[0];
  let form_data = new FormData();
  form_data.append("title", title);
  form_data.append("price", price);
  form_data.append("category", category);
  form_data.append("foto", foto);
  form_data.append("quantity", quantity);
  let response = await fetch("add.php", {
    method: "POST",
    body: form_data,
  });
  let data = await response.json();
  console.log(data);
  addproductbtn.innerHTML = data.message;
  setTimeout(function () {
    addproductbtn.innerHTML = data.message;
  }, 5000);
  setTimeout(function () {
    location.reload();
  }, 2000);
}
let addproductbtn = document.querySelector(".add-product-btn");
addproductbtn.addEventListener("click", function () {
  addproduct();
});

async function addcategory() {
  let categoty = document.querySelector("input[name=categoty]").value;
  let form_data = new FormData();
  form_data.append("categoty", categoty);
  let response = await fetch("addcategory.php", {
    method: "POST",
    body: form_data,
  });
  let data = await response.json();
  addcategorybtn.innerHTML = data.message;
  setTimeout(function () {
    addcategorybtn.innerHTML = "Добавить";
  }, 3000);
  setTimeout(function () {
    location.reload();
  }, 2000);
}

let addcategorybtn = document.querySelector(".add-category-btn");
addcategorybtn.addEventListener("click", function () {
  addcategory();
});

async function removecategory() {
  let removecategoty = document.querySelector(
    "select[name=removecategoty]"
  ).value;
  let form_data = new FormData();
  form_data.append("removecategoty", removecategoty);
  let response = await fetch("deletecategory.php", {
    method: "POST",
    body: form_data,
  });
  let data = await response.json();
  removecategorybtn.innerHTML = data.message;
  setTimeout(function () {
    removecategorybtn.innerHTML = "Удалить";
  }, 3000);
  setTimeout(function () {
    location.reload();
  }, 2000);
}

let removecategorybtn = document.querySelector(".remove-category-btn");
removecategorybtn.addEventListener("click", function () {
  removecategory();
});

async function removeproduct(id) {
  let removeproduct = id;
  let form_data = new FormData();
  form_data.append("removeproduct", removeproduct);
  let response = await fetch("delete.php", {
    method: "POST",
    body: form_data,
  });
    location.reload();
}

let product = document.querySelector("#product");
product.addEventListener("click", function (event) {
  if (event.target.className === "removeproduct") {
    event.preventDefault();
    removeproduct(event.target.dataset.idproduct);
  }
});
