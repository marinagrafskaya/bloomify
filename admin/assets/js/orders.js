async function confirmOrders(id, delivery) {
    let confirm = document.querySelector('.confirm');
    let idorder = id;
    let data = new FormData();
    data.append('id', idorder);
    data.append('delivery', delivery);
    let response = await fetch('ordersconfirm.php', {
        method: 'POST',
        body: data
    });
    location.reload();
}
async function ordercancel(id) {
    let cansel = document.querySelector('.cansel');
    let idorder = id;
    let cause = document.querySelector('.cause').value;
    let data = new FormData();
    data.append('id', idorder);
    data.append('cause', cause);
    let response = await fetch('ordercancel.php', {
        method: 'POST',
        body: data
    });
    location.reload();
}

function filter(status) {
    let itemorder = document.querySelectorAll('.item-order');
    for (let i = 0; i < itemorder.length; i++) {
        itemorder[i].style.display = 'block';
    }
    for (let i = 0; i < itemorder.length; i++) {
        if (itemorder[i].getAttribute('data-status') != status) {
            itemorder[i].style.display = 'none';
        }
    }
}

async function receivedOrders(id) {
    let confirm = document.querySelector('.confirm');
    let idorder = id;
    let data = new FormData();
    data.append('id', idorder);
    let response = await fetch('ordersreceived.php', {
        method: 'POST',
        body: data
    });
    location.reload();
}