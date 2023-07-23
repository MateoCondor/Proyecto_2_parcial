
function agregarIngrediente() {
  // Obtener los valores de los campos de input y select
  const inputNombre = document.getElementById("nameIngredient").value.trim();
  const inputCantidad = document.getElementById("productQuantity").value.trim();
  const inputMedida = document.getElementById("productSelect").value;

  // Verificar si alguno de los campos está vacío
  if (inputNombre === "" || inputCantidad === "" || inputMedida === "") {
    alert("Por favor, complete todos los campos antes de agregar un ingrediente.");
    return; // Detener la ejecución si hay campos vacíos
  }

  const contenedorIngredientes = document.getElementById("ingredientsContainer");
  const tablaIngredientes = document.getElementById("ingredientsTable");

  const trIngredient = document.createElement("tr");
  trIngredient.className = "ingrediente";

  const tdIngredient1 = document.createElement("td");
  tdIngredient1.className = "td1";
  tdIngredient1.textContent = inputNombre;

  const tdIngredient2 = document.createElement("td");
  tdIngredient2.className = "td2";
  tdIngredient2.textContent = inputCantidad;

  const tdIngredient3 = document.createElement("td");
  tdIngredient3.className = "td1";
  tdIngredient3.textContent = inputMedida;

  const tdIngredient4 = document.createElement("td");
  tdIngredient4.className = "td2";
  const botonEliminar = document.createElement("button");
  botonEliminar.className = "botonEliminar";
  botonEliminar.type = "button";
  botonEliminar.textContent = "Eliminar";
  botonEliminar.addEventListener("click", function () { eliminarIngrediente(this); });
  tdIngredient4.appendChild(botonEliminar);

  trIngredient.appendChild(tdIngredient1);
  trIngredient.appendChild(tdIngredient2);
  trIngredient.appendChild(tdIngredient3);
  trIngredient.appendChild(tdIngredient4);

  tablaIngredientes.appendChild(trIngredient);
  contenedorIngredientes.appendChild(tablaIngredientes);

  // Limpiar los campos después de agregar el ingrediente
  document.getElementById("nameIngredient").value = "";
  document.getElementById("productQuantity").value = "";
  document.getElementById("productSelect").selectedIndex = -1;
}



function agregarIngredienteStock() {

  const contenedorIngredientes = document.getElementById("ingredientsContainer");
  const tablaIngredientes = document.getElementById("ingredientsTable");

  const trIngredient = document.createElement("tr");
  trIngredient.className = "ingrediente";

  const tdIngredient1 = document.createElement("td");
  tdIngredient1.className = "td1";
  const inputNombre = document.createElement("input");
  inputNombre.type = "text";
  inputNombre.className = "nombreIngrediente";
  inputNombre.placeholder = "Nombre del ingrediente";
  inputNombre.required = true;
  tdIngredient1.appendChild(inputNombre);

  const tdIngredient2 = document.createElement("td");
  tdIngredient2.className = "td2";
  const inputCantidad = document.createElement("input");
  inputCantidad.type = "number";
  inputCantidad.className = "cantidadIngrediente";
  inputCantidad.placeholder = "Cantidad";
  inputCantidad.required = true;
  tdIngredient2.appendChild(inputCantidad);

  const tdIngredient3 = document.createElement("td");
  tdIngredient3.className = "td1";
  const inputMedida = document.createElement("select");
  inputMedida.className = "medidaIngrediente";
  inputMedida.required = true;

  const opcion1 = document.createElement("option");
  opcion1.value = "Unidades";
  opcion1.textContent = "Unidades";
  inputMedida.appendChild(opcion1);

  const opcion2 = document.createElement("option");
  opcion2.value = "gr";
  opcion2.textContent = "gr";
  inputMedida.appendChild(opcion2);

  const opcion3 = document.createElement("option");
  opcion3.value = "kg";
  opcion3.textContent = "kg";
  inputMedida.appendChild(opcion3);

  const opcion4 = document.createElement("option");
  opcion4.value = "litro";
  opcion4.textContent = "litro";
  inputMedida.appendChild(opcion4);

  const opcion5 = document.createElement("option");
  opcion5.value = "ml";
  opcion5.textContent = "ml";
  inputMedida.appendChild(opcion5);

  tdIngredient3.appendChild(inputMedida);


  const tdIngredient5 = document.createElement("td");
  tdIngredient5.className = "td2";
  const inputPrecio = document.createElement("input");
  inputPrecio.type = "number";
  inputPrecio.className = "precioIngrediente";
  inputPrecio.placeholder = "Precio";
  inputPrecio.required = true;
  tdIngredient5.appendChild(inputPrecio);



  const tdIngredient4 = document.createElement("td");
  tdIngredient4.className = "td1";
  const botonEliminar = document.createElement("button");
  botonEliminar.className = "botonEliminar";
  botonEliminar.type = "button";
  botonEliminar.textContent = "Eliminar";
  botonEliminar.addEventListener("click", function () { eliminarIngrediente(this); });
  tdIngredient4.appendChild(botonEliminar);

  trIngredient.appendChild(tdIngredient1);
  trIngredient.appendChild(tdIngredient2);
  trIngredient.appendChild(tdIngredient3);
  trIngredient.appendChild(tdIngredient5);
  trIngredient.appendChild(tdIngredient4);


  tablaIngredientes.appendChild(trIngredient);
  contenedorIngredientes.appendChild(tablaIngredientes);
}

function eliminarIngrediente(boton) {
  const fila = boton.parentNode.parentNode; 
  const tablaIngredientes = fila.parentNode; 
  tablaIngredientes.removeChild(fila); 
}





