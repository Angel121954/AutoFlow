/**
 * AutoFlow — layout.js
 * Comportamiento global del layout autenticado.
 * Sin ningún onclick en el HTML: todos los eventos se registran aquí.
 */

document.addEventListener('DOMContentLoaded', function () {

    /* ── Referencias DOM ── */
    const sidebar        = document.getElementById('af-sidebar');
    const overlay        = document.getElementById('af-overlay');
    const toggleBtn      = document.getElementById('af-sidebar-toggle');
    const dropdownTrigger = document.getElementById('af-user-dropdown-trigger');
    const dropdown       = document.getElementById('af-user-dropdown');

    /* ── Sidebar mobile: abrir ── */
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.add('open');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        });
    }

    /* ── Sidebar mobile: cerrar con overlay ── */
    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        });
    }

    /* ── Dropdown usuario: toggle ── */
    if (dropdownTrigger) {
        dropdownTrigger.addEventListener('click', function () {
            dropdown.classList.toggle('open');
        });
    }

    /* ── Dropdown usuario: cerrar al clicar fuera ── */
    document.addEventListener('click', function (e) {
        if (dropdown && dropdownTrigger && !dropdownTrigger.contains(e.target)) {
            dropdown.classList.remove('open');
        }
    });

});
