async function reset(id, event) {
  let get = {
    id: id
  }
  let response = await fetch('actions/basket.php', {
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