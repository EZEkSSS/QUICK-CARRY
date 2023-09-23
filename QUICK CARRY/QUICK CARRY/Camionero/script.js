//Cerrar sesion

// Obtener referencia al botón "Cerrar sesión"
var btnlogout = document.getElementById('btn-logout');

// Agregar un controlador de eventos al botón
btnlogout.addEventListener('click', function () {
  // Mostrar mensaje de confirmación
  var confirmar = confirm("¿Deseas cerrar sesión?");

  // Si se confirma, redirigir al usuario
  if (confirmar) {
    window.location.href = "/QUICK CARRY/API AUTENTICACION/Vista/index.html";
  }
});
