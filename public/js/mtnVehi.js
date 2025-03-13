document.addEventListener("DOMContentLoaded", function () {
    cargarMantenimientos(); // Cargar la tabla al cargar la página

    document.querySelector(".btn-filter").addEventListener("click", function () {
        cargarMantenimientos(); // Cargar con filtros cuando se presiona "Filtrar"
    });
});

function cargarMantenimientos() {
    // Obtener los valores de los filtros
    let patente = document.getElementById("filter-patente").value;
    let fecha = document.getElementById("filter-fecha").value;
    let tipoMantencion = document.getElementById("filter-tipo-mtn").value;
    let categoria = document.getElementById("filter-cate-mtn").value;
    let lugar = document.getElementById("filter-lugar").value;
    let costo = document.getElementById("filter-costo").value;
    let descripcion = document.getElementById("filter-desc").value;
    let destacar = document.getElementById("filter-destacar").value;

    // Crear el objeto con los filtros
    let filtros = {
        patente: patente,
        fecha: fecha,
        tipoMantencion: tipoMantencion,
        categoria: categoria,
        lugar: lugar,
        costo: costo,
        descripcion: descripcion,
        destacar: destacar
    };

    // Enviar petición AJAX
    fetch("../../../controller/controllerMtnVehiculo.php?action=filtrar", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(filtros)
    })
    .then(response => response.json())
    .then(data => {

        if (Array.isArray(data)) {
            actualizarTabla(data);
        } else {
            console.error("La respuesta no es un array:", data);
        }
    })
    .catch(error => console.error("Error al cargar los mantenimientos:", error));
}

// Función para actualizar la tabla con los datos filtrados
function actualizarTabla(datos) {
    let tbody = document.querySelector("#table-tipo-mtn tbody");
    tbody.innerHTML = ""; // Limpiar la tabla antes de insertar nuevos datos
    console.log(datos);
    datos.forEach(mtn => {
        let fila = `
            <tr>
                <td>${mtn.patente}</td>
                <td>${mtn.fecha_mtn}</td>
                <td>${mtn.tipo_mantencion}</td>
                <td>${mtn.categoria_mtn}</td>
                <td>${mtn.lugar_mtn}</td>
                <td>${mtn.costo_mtn}</td>
                <td>${mtn.desc_mtn_vehi}</td>
                <td align="center">
                    <a title="Editar" href="indexMtnVehiculo.php?view=edit&id_mtn_vehiculo=${mtn.id_mtn_vehiculo}" class="btn btn-edit btn-xs">
                        <span class="fa fa-edit fw-fa"></span>
                    </a>
                    <a title="Borrar" href="../../../controller/controllerMtnVehiculo.php?action=delete&id_mtn_vehiculo=${mtn.id_mtn_vehiculo}" class="btn btn-delete btn-xs">
                        <span class="fa fa-trash-o fw-fa"></span>
                    </a>
                </td>
            </tr>
        `;
        tbody.innerHTML += fila;
    });
}

// =======================
// EVENTO CATEGORÍA → TIPOS DE MANTENCIÓN
// =======================
document.addEventListener("DOMContentLoaded", function () {

    // Escucha el cambio en el select de categoría
    const selectCategoria = document.getElementById("id_cate_mtn");

    selectCategoria.addEventListener("change", function () {
        const idCategoria = this.value;

        // Fetch al controlador para obtener los tipos de mantención relacionados
        fetch("../../../controller/controllerMtnVehiculo.php?action=tipos_categoria", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id_categoria: idCategoria })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Tipos de mantención recibidos:", data);

            if (Array.isArray(data)) {
                actualizarSelectTipoMantencion(data);
            } else {
                console.error("La respuesta de tipos no es un array:", data);
                limpiarSelectTipoMantencion();
            }
        })
        .catch(error => {
            console.error("Error al cargar los tipos de mantención:", error);
            limpiarSelectTipoMantencion();
        });
    });

    // Limpia el select de tipo mantención (opcional: reiniciar con "Seleccione...")
    function limpiarSelectTipoMantencion() {
        const selectTipoMantencion = document.getElementById("id_tipo_mtn");
        selectTipoMantencion.innerHTML = "<option value='0'>Seleccione...</option>";
    }

    // Llena el select de tipo mantención con los datos recibidos
    function actualizarSelectTipoMantencion(tipos) {
        const selectTipoMantencion = document.getElementById("id_tipo_mtn");

        // Primero, limpiamos el select
        limpiarSelectTipoMantencion();

        // Luego, agregamos las nuevas opciones
        tipos.forEach(tipo => {
            const option = document.createElement("option");
            option.value = tipo.id_tipo_mtn;
            option.textContent = tipo.tipo_mantencion;
            selectTipoMantencion.appendChild(option);
        });
    }
});


// =======================
// EVENTO TIPO → ACTUALIZAR CATEGORÍA AUTOMÁTICAMENTE
// =======================
document.addEventListener("DOMContentLoaded", function () {

    const selectTipo = document.getElementById("id_tipo_mtn");

    selectTipo.addEventListener("change", function () {
        const idTipo = this.value;

        // Si no se ha seleccionado un tipo válido, no hacemos nada
        if (idTipo === "0") {
            return;
        }

        // Fetch al controlador para obtener la categoría del tipo de mantención
        fetch("../../../controller/controllerMtnVehiculo.php?action=categoria_tipo", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id_tipo_mtn: idTipo })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Categoría correspondiente recibida:", data);

            if (data && data.id_cate_mtn) {
                const selectCategoria = document.getElementById("id_cate_mtn");

                // Actualizamos el select de categoría si es diferente al actual
                if (selectCategoria.value !== data.id_cate_mtn) {
                    selectCategoria.value = data.id_cate_mtn;

                    // Opcional: después de cambiar la categoría, actualizamos los tipos nuevamente
                    actualizarTiposPorCategoria(data.id_cate_mtn, idTipo);
                }
            } else {
                console.error("Respuesta incorrecta:", data);
            }
        })
        .catch(error => {
            console.error("Error al obtener la categoría del tipo:", error);
        });
    });

    // Función para actualizar el select de tipo mantención según la categoría, 
    // y opcionalmente seleccionar un tipo específico
    function actualizarTiposPorCategoria(idCategoria, idTipoSeleccionado = null) {
        fetch("../../../controller/controllerMtnVehiculo.php?action=tipos_categoria", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ id_categoria: idCategoria })
        })
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data)) {
                const selectTipo = document.getElementById("id_tipo_mtn");

                // Limpiamos y agregamos los tipos de mantención
                selectTipo.innerHTML = "<option value='0'>Seleccione...</option>";
                data.forEach(tipo => {
                    const option = document.createElement("option");
                    option.value = tipo.id_tipo_mtn;
                    option.textContent = tipo.tipo_mantencion;
                    // Si coincide con el id_tipo seleccionado, lo marcamos como seleccionado
                    if (idTipoSeleccionado && tipo.id_tipo_mtn == idTipoSeleccionado) {
                        option.selected = true;
                    }
                    selectTipo.appendChild(option);
                });
            } else {
                console.error("Respuesta de tipos no es un array:", data);
            }
        })
        .catch(error => {
            console.error("Error al actualizar tipos de mantención:", error);
        });
    }
});
