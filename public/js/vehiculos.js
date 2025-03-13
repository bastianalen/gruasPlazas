document.addEventListener('DOMContentLoaded', () => {
    // Selección de elementos globales
    const cuadros = document.querySelectorAll('.vehiculos-especifico');
    const modal = document.getElementById('modal-vehiculos');
    const modalTitulo = document.getElementById('modal-titulo');
    const modalImagen = document.getElementById('modal-imagen');
    const cerrarModal = document.querySelector('.cerrar-modal');
    const tablaMantenciones = document.querySelector('.informacion-mantenciones');

    // Abrir modal al hacer clic en un cuadro
    if (cuadros.length && modal && modalTitulo && modalImagen) {
        cuadros.forEach(cuadro => {
            cuadro.addEventListener('click', () => {
                const patente = cuadro.dataset.patente;
                const gruaSeleccionada = cuadro.dataset.nombre;
                const imagenCamion = cuadro.querySelector('.camion-imagen').src;

                // Actualiza el contenido del modal
                modalTitulo.textContent = `${gruaSeleccionada}`;
                modalImagen.src = imagenCamion;
                modal.classList.add('mostrar');

                // Solicitar las mantenciones del vehículo seleccionado
                obtenerMantenciones(patente);
            });
        });
    }

    function obtenerMantenciones(patente) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `mantencionesVehiculos.php?patente=${patente}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const mantenciones = JSON.parse(xhr.responseText);
                mostrarMantenciones(mantenciones);
            }
        };
        xhr.send();
    }

    function mostrarMantenciones(mantenciones) {
        // Limpia la tabla antes de agregar nuevos datos
        tablaMantenciones.innerHTML = `
        <tr> 
            <th>Mantención</th> 
            <th>Realizado</th> 
            <th>Descripción</th> 
            <th>Estado por fecha</th> 
            <th>Kilometraje recomendado</th> 
            <th>Más información</th> 
        </tr>`;

        
        if (mantenciones.length === 0) {
            // Si no hay mantenciones, muestra el mensaje
            tablaMantenciones.innerHTML += `
            <tr>
            <td colspan="6" style="text-align: center; font-weight: bold;">
            No hay mantenciones registradas para este vehículo.
            </td>
            </tr>`;
            return; // Sale de la función para no seguir ejecutando el código
        }
        mantenciones.forEach(mantencion => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${mantencion.tipo_mantencion}</td>
                <td>${mantencion.fecha_mtn}</td>
                <td>${mantencion.desc_mtn_vehi}</td>
                <td class="${mantencion.estadoMantencion}">${mantencion.estadoMantencionTexto}</td>
                <td class="${mantencion.km_recomen}">${mantencion.km_recomen}</td>
                <td>
                    <span class="icono-redireccion">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </span>
                </td>
            `;
            console.log(mantencion);
            tablaMantenciones.appendChild(row);
        });
    }

    // Función para cerrar el modal
    if (cerrarModal && modal) {
        cerrarModal.addEventListener('click', () => {
            modal.classList.remove('mostrar');
        });

        // Cerrar el modal haciendo clic fuera de él
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('mostrar');
            }
        });
    }

    // Redirección a mantención específica
    const iconosRedireccion = document.querySelectorAll('.icono-redireccion');
    if (iconosRedireccion.length) {
        iconosRedireccion.forEach(icono => {
            icono.addEventListener('click', function () {
                const camion = this.getAttribute('data-camion');
                const info = this.getAttribute('data-info');
                window.location.href = `/mantenciones.php?camion=${camion}&info=${info}`;
            });
        });
    }

    // Dinamismo para la vista previa de la imagen del vehículo
    const inputImagen = document.getElementById('imagen_vehi');
    const vistaPrevia = document.getElementById('vista-previa');

    if (inputImagen && vistaPrevia) {
        inputImagen.addEventListener('change', function () {
            const archivo = this.files[0];
            if (archivo && archivo.type.startsWith('image/')) {
                const lector = new FileReader();

                lector.onload = function (e) {
                    vistaPrevia.innerHTML = `<img src="${e.target.result}" alt="Vista previa" style="max-width: 100%; max-height: 100%;">`;
                };

                lector.readAsDataURL(archivo);
            } else {
                vistaPrevia.innerHTML = '<p>Vista previa</p>';
            }
        });
    }
});
