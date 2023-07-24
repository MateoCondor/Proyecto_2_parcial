const register = document.getElementById("register");
const login = document.getElementById("login");
const container = document.getElementById("container");
const usuarioBase ="admin";
const passwordBase ="1234";
function validarNombre() {
  let expRegNombre = /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
  let nombreControl = false;
  let nombre = "";

  nombre = document.getElementById("usuarioLogin").value;
  password = document.getElementById("passwordLogin").value;
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
function inciarSesion() {
  
  if (validarNombre()) {
    alert("Bienvenido");
    window.location.href = "inicio_administrador.html";
  }
}


register.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

login.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});



const loginButton = document.getElementById("iniciarSesionLogin");
loginButton.addEventListener("click", () => {
  inciarSesion();
});

