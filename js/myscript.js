// Función para agregar un ingrediente
function agregarIngrediente() {
  // Obtener el contenedor de los ingredientes
  const contenedorIngredientes = document.getElementById("ingredientsContainer");
  const tablaIngredientes = document.getElementById("ingredientsTable");

  const trIngredient = document.createElement("tr");
  trIngredient.className = "ingrediente";

  // Crear los elementos dentro del div del ingrediente
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

  const tdIngredient4 = document.createElement("td");
  tdIngredient4.className = "td2";
  const botonEliminar = document.createElement("button");
  botonEliminar.className = "botonEliminar";
  botonEliminar.type = "button";
  botonEliminar.textContent = "Eliminar";
  botonEliminar.addEventListener("click", function () { eliminarIngrediente(this); });
  tdIngredient4.appendChild(botonEliminar);

  // Agregar los elementos al div del ingrediente
  trIngredient.appendChild(tdIngredient1);
  trIngredient.appendChild(tdIngredient2);
  trIngredient.appendChild(tdIngredient3);
  trIngredient.appendChild(tdIngredient4);


  tablaIngredientes.appendChild(trIngredient);
  contenedorIngredientes.appendChild(tablaIngredientes);
}


function agregarIngredienteStock() {
  // Obtener el contenedor de los ingredientes
  const contenedorIngredientes = document.getElementById("ingredientsContainer");
  const tablaIngredientes = document.getElementById("ingredientsTable");

  const trIngredient = document.createElement("tr");
  trIngredient.className = "ingrediente";

  // Crear los elementos dentro del div del ingrediente
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

  // Agregar los elementos al div del ingrediente
  trIngredient.appendChild(tdIngredient1);
  trIngredient.appendChild(tdIngredient2);
  trIngredient.appendChild(tdIngredient3);
  trIngredient.appendChild(tdIngredient5);
  trIngredient.appendChild(tdIngredient4);


  tablaIngredientes.appendChild(trIngredient);
  contenedorIngredientes.appendChild(tablaIngredientes);
}

// Función para eliminar un ingrediente
function eliminarIngrediente(boton) {
  const fila = boton.parentNode.parentNode; // Obtener el elemento <tr> (fila) que contiene el botón
  const tablaIngredientes = fila.parentNode; // Obtener la tabla que contiene la fila
  tablaIngredientes.removeChild(fila); // Eliminar la fila de la tabla
}





