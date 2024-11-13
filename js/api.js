"use strict"

const URL = "api/productos/";

let productos = [];

let form = document.querySelector('#producto-form');
form.addEventListener('submit', insertproducto);


/**
 * Obtiene todas las tareas de la API REST
 */
async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        productos = await response.json();

        showproductos();
    } catch(e) {
        console.log(e);
    }
}

/**
 * Inserta la tarea via API REST
 */
async function insertproducto(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let productos = {
        nombre: data.get('nombre'),
        marca: data.get('marca'),
        capacidad: data.get('capacidad'),
        precio: data.get('precio'),
        descripcion: data.get('descripcion'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(task)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let producto= await response.json();

        // inserto la tarea nuevo
        productos.push(producto);
        showproducto();

        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteproducto(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.task;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        productos = productos.filter(producto => producto.id != id);
        showproductos();
    } catch(e) {
        console.log(e);
    }
}



function showproducto() {
    let ul = document.querySelector("#producto-list");
    ul.innerHTML = "";
    for (const producto of productos) {

        let html = `
            <li class='
                    list-group-item d-flex justify-content-between align-items-center
                    ${ producto.finalizada == 1 ? 'finalizada' : ''}
                '>
                <span> <b>${producto.nombre}</b> - ${producto.marca} (precio ${producto.precio})(capacidad ${producto.capacidad})(descripcion ${producto.descripcion}) </span>
                <div class="ml-auto">
                    ${producto.finalizada != 1 ? `<a href='#' data-task="${produto.id}" type='button' class='btn btn-success btn-finalize'>Finalizar</a>` : ''}
                    <a href='#' data-task="${producto.id}" type='button' class='btn btn-danger btn-delete'>Borrar</a>
                </div>
            </li>
        `;

        ul.innerHTML += html;
    }

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteproducto);
    }

    const btnsFinalizar = document.querySelectorAll('a.btn-finalize');
    for (const btnFinalizar of btnsFinalizar) {
        btnFinalizar.addEventListener('click', finalizeproducto);
    }
}

getAll();
