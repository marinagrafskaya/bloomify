async function editingproduct() {
    let id = document.querySelector("input[name=id]").value;
    let title = document.querySelector("input[name=title]").value;
    let price = document.querySelector("input[name=price]").value;
    let category = document.querySelector("select[name=category]").value;
    let quantity = document.querySelector("input[name=quantity]").value;
    let foto = document.querySelector("input[name=foto]").files[0];
    let form_data = new FormData();
    form_data.append('id', id);
    form_data.append('title', title);
    form_data.append('price', price);
    form_data.append('category', category);
    form_data.append('foto', foto);
    form_data.append('quantity', quantity);
    let response = await fetch('update.php', {
        method: 'POST',
        body: form_data
    });
    let data = await response.json();
    editingproductbtn.innerHTML = data.message;
    setTimeout(function() {
        editingproductbtn.innerHTML = "Изменить";
    }, 3000)
}
let editingproductbtn = document.querySelector('.editing-product-btn'); 
editingproductbtn.addEventListener('click', function(){
    editingproduct();
});

let img = document.querySelector('.foto-editing .img img');
let file = document.querySelector('.file');
file.onchange = function(event) {
    let target = event.target;
    let fileReader = new FileReader();
    fileReader.onload = function() {
        img.src = fileReader.result;
    }
    fileReader.readAsDataURL(target.files[0]);
}