/**
 * AutoFlow — profile.js
 * Interactividad de la página de perfil.
 * Sin ningún onclick en el HTML.
 */

document.addEventListener('DOMContentLoaded', function () {

    const showDeleteBtn   = document.getElementById('af-show-delete-btn');
    const deleteConfirm   = document.getElementById('af-delete-confirm');
    const cancelDeleteBtn = document.getElementById('af-cancel-delete-btn');

    /* ── Mostrar formulario de confirmación ── */
    if (showDeleteBtn) {
        showDeleteBtn.addEventListener('click', function () {
            deleteConfirm.classList.add('is-visible');
            showDeleteBtn.classList.add('af-hidden');
        });
    }

    /* ── Cancelar y volver al botón original ── */
    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', function () {
            deleteConfirm.classList.remove('is-visible');
            showDeleteBtn.classList.remove('af-hidden');
        });
    }

});
