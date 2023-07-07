//codigo en el cual si se toca fuera del menu se cierra el mismo
var menuToggle = document.getElementById('menu-toggle');
var menu = document.querySelector('.menu');

document.addEventListener('click', function (event) {
  var target = event.target;

  if (target != menuToggle && !menu.contains(target)) {
    menuToggle.checked = false;
  }
});


//Cerrar sesion

// Obtener referencia al botón "Cerrar sesión"
var btnlogout = document.getElementById('btn-logout');

// Agregar un controlador de eventos al botón
btnlogout.addEventListener('click', function() {
  // Mostrar mensaje de confirmación
  var confirmar = confirm("¿Deseas cerrar sesión?");

  // Si se confirma, redirigir al usuario
  if (confirmar) {
    window.location.href = "/QUICK CARRY/homepage/index.html";
  }
});
