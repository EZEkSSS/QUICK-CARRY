//codigo en el cual si se toca fuera del menu se cierra el mismo
var menuToggle = document.getElementById('menu-toggle');
var menu = document.querySelector('.menu');

document.addEventListener('click', function (event) {
  var target = event.target;

  if (target != menuToggle && !menu.contains(target)) {
    menuToggle.checked = false;
  }
});