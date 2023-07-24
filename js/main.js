const register = document.getElementById("register");
const login = document.getElementById("login");
const container = document.getElementById("container");
const usuarioBase ="admin";
const passwordBase ="1234";
function validarNombre() {
  let expRegNombre = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
  let nombreControl = false;
  let nombre = "";

  nombre = document.getElementById("usuario").value;
  password = document.getElementById("password").value;
  if (nombre.length == 0 || !expRegNombre.exec(nombre)) {
    alert("Solo se admiten letras y espacios");
    
  } 
  if (password.length == 0) {
    alert("Ingrese una contraseña");
  }else{
    if (usuarioBase==nombre && passwordBase==password) {
      nombreControl=true;
    } else {
      nombreControl=false;
      alert("Usuario o contraseña incorrectos");
    }
  }
  return nombreControl;
}

const loginButton = document.getElementById("iniciarSesionLogin");

register.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

login.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

loginButton.addEventListener("click", () => {
  
});

function inciarSesion() {
  
  if (validarNombre()) {
    alert("Bienvenido");
    window.location.href = "http://" + document.domain + "/inicio_administrador.html";
  }
  
  
  
}

document.getElementById("enlaceIniciarSesion").addEventListener("click", function() {
  inciarSesion();
});