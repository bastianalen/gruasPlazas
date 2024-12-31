// Selecciona el camion, la iformación y el modal
const cuadros = document.querySelectorAll('.camiones-especifico');
const modal = document.getElementById('modal-camiones');
const modalTitulo = document.getElementById('modal-titulo');
const modalImagen = document.getElementById('modal-imagen');
const cerrarModal = document.querySelector('.cerrar-modal');


// Función para abrir el modal
cuadros.forEach(cuadro => {
    cuadro.addEventListener('click', () => {
        const gruaSeleccionada = cuadro.dataset.grua;
        const imagenCamion = cuadro.querySelector('.camion-imagen').src;

        // Actualiza el contenido del modal
        modalTitulo.textContent = `mantenciones ${gruaSeleccionada}`;
        modalImagen.src = imagenCamion;
        modal.classList.add('mostrar');
    });
});

// Función para cerrar el modal
cerrarModal.addEventListener('click', () => {
    modal.classList.remove('mostrar');
});

// Cerrar el modal haciendo clic fuera de él
modal.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.classList.remove('mostrar');
    }
});


// Función para dirigirse a la vista de la mantención especifica
document.querySelectorAll('.icono-redireccion').forEach(icono => {
    icono.addEventListener('click', function() {
        const camion = this.getAttribute('data-camion');
        const info = this.getAttribute('data-info');
        window.location.href = `/mantenciones.php?camion=${camion}&info=${info}`;
    });
});