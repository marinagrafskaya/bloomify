async function remove(id) {
    let removeorderbtn = document.querySelector('.order-remove');
    let idproduct = {
      id: id
    }
    let response = await fetch('actions/removeorders.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json;charset=utf-8'
      },
      body: JSON.stringify(idproduct)
    });
    location.reload();
  }