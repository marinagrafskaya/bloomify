let filterSelect = document.querySelector('.filter');
let sortSelect = document.querySelector('.sort');
let arr = [];
document.querySelectorAll(".itemproduct").forEach(elem => {
  arr.push({
    "id": elem.querySelector("input[name=tovar]").value,
    "title": elem.querySelector("h3").innerHTML,
    "foto": elem.querySelector(".img img").src,
    "price": elem.querySelector("p").innerHTML.slice(0, -1),
    "category": elem.querySelector("input[name=category]").value,
    "quantity": elem.querySelector("input[name=quantity]").value
  });
});
let sortArr = arr;
function show(array) {
  let product = document.querySelector("#product");
  while (product.firstChild) {
    product.removeChild(product.lastChild);
  };
  let quantity;
  array.forEach(elem => {
    if(elem.quantity > 0) {
      quantity = `<p class='button-basket' onclick="reset(${elem.id}, event )">В корзину</p>`;
    } else {
      quantity = `<p>Нет в наличии</p>`;
    }
    product.innerHTML += `
    <div class="itemproduct">
    <input type="hidden" class="itemproduct1" name="tovar" value="${elem.id}">
    <div class="img" onclick="product(${elem.id})"><img src="${elem.foto}"></div>
    <h3>${elem.title}</h3>
    <div class="infoproduct">
    <p class="product-price">${elem.price} ₽</p>
    ${quantity}
    </div>;
    </div>`;
  });
  none();
}
let filter = function (arr) {
  let filtervalue = document.querySelector('.filter').value;
  let arrFilter = arr.filter(function (znachenie, index) {
    return znachenie.category === filtervalue;
  })
  sortArr = arrFilter;
  show(arrFilter);
  sortSelect.selectedIndex = 0;
}


filterSelect.oninput = function () {
  filter(arr);
}

sortSelect.oninput = function () {
  if (this.value === "Title") {
    sortArr.sort((a, b) => {
      const nameA = a.title.toUpperCase(); // ignore upper and lowercase
      const nameB = b.title.toUpperCase(); // ignore upper and lowercase
      if (nameA < nameB) {
        return -1;
      }
      if (nameA > nameB) {
        return 1;
      }
      return 0;
    });
  };
  if (this.value === "Price") {
    sortArr.sort((a, b) => a.price - b.price);
  };
  show(sortArr);
}


