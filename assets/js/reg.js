async function register() {
    let name = document.querySelector("input[name=name]").value;
    let surname = document.querySelector("input[name=surname]").value;
    let patronymic = document.querySelector("input[name=patronymic]").value;
    let login = document.querySelector("input[name=login]").value;
    let password = document.querySelector("input[name=password]").value;
    let password_confir = document.querySelector("input[name=password_confir]").value;
    let message = document.querySelector('.message');
    let form_data = new FormData();
    form_data.append('name', name);
    form_data.append('surname', surname);
    form_data.append('patronymic', patronymic);
    form_data.append('login', login);
    form_data.append('password', password);
    form_data.append('password_confir', password_confir);
    let response = await fetch('actions/signup.php', {
        method: 'POST',
        body: form_data
    });
    let data = await response.json();
    if (data.status === true) {
        location.href = 'autreg.php';
        message.style.display = 'none';
        message.innerHTML = '';
        loginbutton.classList.remove('animation-remove');
    } else {
        data.fields.forEach(function (item) {
            document.querySelector(`input[name=${item}]`).parentNode.classList.add('error');
        });
         message.style.display = 'block';
        message.innerHTML = data.message;
        btnregister.classList.remove('animation-remove');

    }
}

let btnregister = document.querySelector('.register-btn');
btnregister.addEventListener('click', function (e) {
    e.preventDefault();
    let error = document.querySelectorAll('input');
    error.forEach(function (item) {
        item.parentNode.classList.remove('error');
    })
    btnregister.classList.add('animation-remove');
    register();
})

