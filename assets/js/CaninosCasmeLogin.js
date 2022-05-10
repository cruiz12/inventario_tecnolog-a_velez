document.addEventListener("DOMContentLoaded", function() {
document.getElementById("Form_InicioSesion").addEventListener('submit', ValidarFormulario); 
});

function ValidarFormulario(evento) {
  evento.preventDefault();
  var usuario = document.getElementById('login-name').value;
  var clave = document.getElementById('login-pass').value;
  if(usuario.length == 0 || clave.length == 0) {
    alert('¡Datos en blanco! Por favor complete todos los campos.');
    document.getElementById("login-name").style.border = "3px solid red";
    document.getElementById("login-pass").style.border = "3px solid red";
    return;
    }
  if(usuario.length == 0){
    alert('¡El campo usuario no puede quedar vacío');
    document.getElementById("login-name").style.border = "3px solid red";
    return;
  }
  if(clave.length == 0){
    alert('¡El campo contraseña no puede quedar vacío');
    document.getElementById("login-pass").style.border = "3px solid red";
    return;
  }
  this.submit();
}