async function pickuppoint(idUser,idpickuppoint) {
  let get = {
    id_user: idUser,
    id_pick_up_point: idpickuppoint
  }
  let response = await fetch('actions/changing_method.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json;charset=utf-8'
    },
    body: JSON.stringify(get)
  });
  let content = await response.json();
  event.target.innerHTML = content.message;
  event.target.classList.remove('animation-remove');
};