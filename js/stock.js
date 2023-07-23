let productos = [
    { nombre: "Harina", cantidad: 5, unidad: "kg", precio: 2.5 },
    { nombre: "Leche", cantidad: 9, unidad: "litros", precio: 0.95 },
    { nombre: "Huevos", cantidad: 2, unidad: "Unidades", precio: 0.15 },
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
    let nombreProductoBuscado = document.getElementById("inputProducto").value;

    let productoEncontrado = buscarProducto(nombreProductoBuscado);

    let tablaProductosDiv = document.getElementById("tablaProductos");
    tablaProductosDiv.innerHTML = "";

    if (productoEncontrado) {
        imprimirProductoEnTabla(productoEncontrado);
    } else {
        alert("Producto no encontrado");
    }
}
