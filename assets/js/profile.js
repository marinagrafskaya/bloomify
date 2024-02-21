function sum() {
    let price_product = document.querySelectorAll('.price-product');
    let sum = 0;
    for (let i = 0; i < price_product.length; i++) {
        sum += (+price_product[i].getAttribute('data-price') * price_product[i].parentNode.querySelector('.out').innerHTML);
    }
    let sumzakaz = document.querySelector('.sum-zakaz span')
    sumzakaz.innerHTML = String(sum);
}
if (document.querySelector("input[name=cart]").value === 'true') {
    sum();
    let makeanorder = document.querySelector('.make-an-order');
    let basketproduct = document.querySelector('.basket-product');
    makeanorder.addEventListener('click', function(event) {
        if (event.target.className == 'btn-zakaz') {
            addorder(order(), event);
        }

    });

    basketproduct.addEventListener('click', function(event) {
        let max = event.target.dataset.max;
        let min = 1;
        let out_value = event.target.parentNode.querySelector('.out').innerHTML;
        let out = event.target.parentNode.querySelector('.out');
        if (event.target.className == 'plus') {
            if (out_value < max) {
                out.innerHTML = String(+out_value + 1);
            } else {
                event.target.classList.add('noquantity')
                setTimeout(function() {
                    event.target.classList.remove('noquantity')
                }, 2000)
            }
        }
        if (event.target.className == 'minus') {
            if (out_value > min) {
                out.innerHTML = String(+out_value - 1);
            } else {
                event.target.classList.add('noquantity')
                setTimeout(function() {
                    event.target.classList.remove('noquantity')
                }, 2000)
            }
        }


        sum();


    });
}

function order() {
    let arr = [];
    document.querySelectorAll(".itembasket").forEach(elem => {
        arr.push({
            id: elem.querySelector("input[name=id]").value,
            quantity: elem.querySelector(".out").innerHTML
        });
    });
    return arr;
}

async function addorder(order) {
    let idproduct = {
        order: order,
        sum: document.querySelector('.sum-zakaz span').innerHTML,
        address: document.querySelector("textarea[name=address]").value
    }
    let response = await fetch('actions/addorder.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(idproduct)
    });
    let response2 = await fetch('actions/cartout.php');
    let data2 = await response2.json();
    if(data2 == "1") {
        location.href = 'order.php';
    }  
    }
    

async function removeproduct(id) {
    let idproduct = {
      id: id
    }
    let response = await fetch('actions/removeproduct.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json;charset=utf-8'
      },
      body: JSON.stringify(idproduct)
    });
    location.reload();
  }
