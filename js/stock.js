let productos = [
    { nombre: "Harina", cantidad: 5, unidad: "kg", precio: 2.5 },
    { nombre: "Leche", cantidad: 2, unidad: "litros", precio: 0.95 },
    { nombre: "Huevos", cantidad: 1, unidad: "Unidades", precio: 0.15 },
    { nombre: "Polvo de hornear", cantidad: 1, unidad: "gr", precio: .10 }
];

function buscarProducto(nombreProducto) {
    for (let i = 0; i < productos.length; i++) {
        
        if (productos[i].nombre === nombreProducto) {
            return productos[i];
        }
    }
    return null;
}

function imprimirProductoEnTabla(producto) {
    const contenedorIngredientes = document.getElementById("ingredientsContainer");
    let tabla = document.getElementById("ingredientsTable");
    let filaProducto = document.createElement("tr");

   
    let celdaNombre = document.createElement("td");
    let celdaCantidad = document.createElement("td");
    let celdaUnidad = document.createElement("td");
    let celdaPrecio = document.createElement("td");

    celdaNombre.textContent = producto.nombre;
    celdaCantidad.textContent = producto.cantidad;
    celdaUnidad.textContent = producto.unidad;
    celdaPrecio.textContent = "$" + producto.precio.toFixed(2); 


    filaProducto.appendChild(celdaNombre);
    filaProducto.appendChild(celdaCantidad);
    filaProducto.appendChild(celdaUnidad);
    filaProducto.appendChild(celdaPrecio);


    tabla.appendChild(filaProducto);


    contenedorIngredientes.appendChild(tabla);
}

function buscarProductoPorNombre() {
    // Obtenemos el valor del input donde se ingresó el nombre del producto a buscar
    let nombreProductoBuscado = document.getElementById("inputProducto").value;

    // Buscamos el producto en el arreglo
    let productoEncontrado = buscarProducto(nombreProductoBuscado);

    // Limpiamos la tabla anterior antes de imprimir la nueva
    let tablaProductosDiv = document.getElementById("tablaProductos");
    tablaProductosDiv.innerHTML = "";

    // Mostramos el resultado en la tabla, si el producto fue encontrado
    if (productoEncontrado) {
        imprimirProductoEnTabla(productoEncontrado);
    } else {
        alert("Producto no encontrado");
    }
}
