/**
 * AutoFlow — layout.js
 * Comportamiento global del layout autenticado.
 * Sin ningún onclick/onkeydown en el HTML.
 */

document.addEventListener('DOMContentLoaded', function () {

    /* ── Referencias DOM ── */
    const sidebar         = document.getElementById('af-sidebar');
    const overlay         = document.getElementById('af-overlay');
    const toggleBtn       = document.getElementById('af-sidebar-toggle');
    const pill            = document.getElementById('af-user-pill');
    const dropdown        = document.getElementById('af-user-dropdown');

    /* ══════════════════════════════════════
       SIDEBAR MOBILE
    ══════════════════════════════════════ */

    if (toggleBtn && sidebar && overlay) {
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.add('open');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        });

        overlay.addEventListener('click', function () {
            _closeSidebar();
        });
    }

    function _closeSidebar() {
        if (!sidebar || !overlay) return;
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    /* ══════════════════════════════════════
       DROPDOWN DE USUARIO
    ══════════════════════════════════════ */

    if (pill && dropdown) {

        /* Toggle al clicar el pill */
        pill.addEventListener('click', function (e) {
            e.stopPropagation();
            const isOpen = dropdown.classList.contains('open');
            isOpen ? _closeDropdown() : _openDropdown();
        });

        /* Cerrar al clicar fuera */
        document.addEventListener('click', function (e) {
            if (!pill.contains(e.target) && !dropdown.contains(e.target)) {
                _closeDropdown();
            }
        });

        /* Cerrar con Escape */
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') _closeDropdown();
        });

        /* Navegación por teclado dentro del dropdown */
        dropdown.addEventListener('keydown', function (e) {
            const items = Array.from(
                dropdown.querySelectorAll('.af-user-dropdown__item:not([disabled])')
            );
            const idx = items.indexOf(document.activeElement);

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                const next = items[idx + 1] ?? items[0];
                next?.focus();
            }
            if (e.key === 'ArrowUp') {
                e.preventDefault();
                const prev = items[idx - 1] ?? items[items.length - 1];
                prev?.focus();
            }
        });
    }

    function _openDropdown() {
        if (!dropdown || !pill) return;
        dropdown.classList.add('open');
        pill.classList.add('is-open');
        pill.setAttribute('aria-expanded', 'true');
        /* Foco al primer ítem del dropdown */
        setTimeout(() => {
            dropdown.querySelector('.af-user-dropdown__item')?.focus();
        }, 60);
    }

    function _closeDropdown() {
        if (!dropdown || !pill) return;
        dropdown.classList.remove('open');
        pill.classList.remove('is-open');
        pill.setAttribute('aria-expanded', 'false');
    }

});
