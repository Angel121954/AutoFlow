/* ============================================================
   AutoFlow — automations-index.js
   Lógica JS para la vista index de automatizaciones:
   · Filtros de búsqueda / estado / trigger
   · Apertura y cierre del modal compartido
   · Selección visual de trigger en el modal
   · Confirmación de eliminación con SweetAlert2
   ============================================================ */

/* ══════════════════════════════════════
   FILTROS
══════════════════════════════════════ */
let currentFilter  = 'all';
let currentTrigger = '';

function filterAutomations() {
    applyFilters();
}

function setFilter(status, btn) {
    currentFilter = status;
    document.querySelectorAll('.af-filter-pill')
        .forEach(p => p.classList.remove('af-filter-pill--active'));
    btn.classList.add('af-filter-pill--active');
    applyFilters();
}

function filterByTrigger(val) {
    currentTrigger = val;
    applyFilters();
}

function applyFilters() {
    const q = (document.getElementById('af-search-input').value || '').toLowerCase();
    document.querySelectorAll('.af-automation-card').forEach(card => {
        const matchSearch  = !q || (card.dataset.name || '').includes(q);
        const matchStatus  = currentFilter === 'all' || card.dataset.status === currentFilter;
        const matchTrigger = !currentTrigger || card.dataset.trigger === currentTrigger;
        card.style.display = (matchSearch && matchStatus && matchTrigger) ? '' : 'none';
    });
}

/* ══════════════════════════════════════
   MODAL — abrir / cerrar
══════════════════════════════════════ */
let _modalOpen = false;

function openModal() {
    document.getElementById('af-automation-modal').classList.add('open');
    document.body.style.overflow = 'hidden';
    _modalOpen = true;
}

function closeModal() {
    document.getElementById('af-automation-modal').classList.remove('open');
    document.body.style.overflow = '';
    _modalOpen = false;
}

function handleBackdropClick(e) {
    if (e.target === document.getElementById('af-automation-modal')) closeModal();
}

/* ══════════════════════════════════════
   MODAL — CREAR
   (storeUrl se inyecta desde el blade)
══════════════════════════════════════ */
function openCreateModal() {
    document.getElementById('af-automation-form').action = window.AF_STORE_URL;
    document.getElementById('af-form-method').value = 'POST';
    document.getElementById('af-editing-id').value  = '';

    document.getElementById('modal-name').value        = '';
    document.getElementById('modal-description').value = '';
    document.getElementById('modal-active').checked    = true;
    clearTriggerSelection();

    document.getElementById('af-modal-title').textContent        = 'Nueva automatización';
    document.getElementById('af-modal-subtitle').textContent     = 'Configura un flujo automático para tu negocio';
    document.getElementById('af-modal-submit-text').textContent  = 'Crear automatización';
    document.getElementById('af-modal-status-label').textContent = 'Estado inicial';
    document.getElementById('af-modal-status-title').textContent = 'Activar al crear';
    document.getElementById('af-modal-status-desc').textContent  = 'La automatización comenzará a ejecutarse inmediatamente';

    document.getElementById('af-modal-icon').innerHTML = `
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>`;

    openModal();
    setTimeout(() => document.getElementById('modal-name').focus(), 150);
}

/* ══════════════════════════════════════
   MODAL — EDITAR
══════════════════════════════════════ */
function openEditModal(data) {
    document.getElementById('af-automation-form').action = `/automations/${data.id}`;
    document.getElementById('af-form-method').value = 'PUT';
    document.getElementById('af-editing-id').value  = data.id;

    document.getElementById('modal-name').value        = data.name;
    document.getElementById('modal-description').value = data.description || '';
    document.getElementById('modal-active').checked    = data.active;
    setTriggerSelection(data.trigger_type);

    document.getElementById('af-modal-title').textContent        = 'Editar automatización';
    document.getElementById('af-modal-subtitle').textContent     = `Modificando «${data.name}»`;
    document.getElementById('af-modal-submit-text').textContent  = 'Guardar cambios';
    document.getElementById('af-modal-status-label').textContent = 'Estado de la automatización';
    document.getElementById('af-modal-status-title').textContent = 'Automatización activa';
    document.getElementById('af-modal-status-desc').textContent  = 'Desactiva temporalmente sin eliminar la configuración';

    document.getElementById('af-modal-icon').innerHTML = `
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>`;

    openModal();
    setTimeout(() => document.getElementById('modal-name').focus(), 150);
}

/* ══════════════════════════════════════
   TRIGGER SELECTION
══════════════════════════════════════ */
function clearTriggerSelection() {
    document.querySelectorAll('#af-modal-trigger-grid .af-modal-trigger-option').forEach(opt => {
        opt.classList.remove('af-modal-trigger-option--selected');
        opt.querySelector('input[type="radio"]').checked = false;
    });
}

function setTriggerSelection(value) {
    clearTriggerSelection();
    const target = document.querySelector(
        `#af-modal-trigger-grid .af-modal-trigger-option[data-value="${value}"]`
    );
    if (target) {
        target.classList.add('af-modal-trigger-option--selected');
        target.querySelector('input[type="radio"]').checked = true;
    }
}

function selectModalTrigger(el) {
    clearTriggerSelection();
    el.classList.add('af-modal-trigger-option--selected');
    el.querySelector('input[type="radio"]').checked = true;
}

/* ══════════════════════════════════════
   DELETE — SweetAlert2
══════════════════════════════════════ */
function confirmDelete(id, name) {
    Swal.fire({
        title: '¿Eliminar automatización?',
        html:  `La automatización <strong>«${name}»</strong> será eliminada permanentemente junto con todos sus registros de ejecución.`,
        icon:  'warning',
        showCancelButton:  true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText:  'Cancelar',
        reverseButtons:    true,
        focusCancel:       true,
        customClass: {
            popup:         'af-swal-popup',
            confirmButton: 'af-swal-confirm',
            cancelButton:  'af-swal-cancel',
        },
        buttonsStyling: false,
    }).then(result => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
}

/* ══════════════════════════════════════
   KEYBOARD — Esc cierra el modal
══════════════════════════════════════ */
document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && _modalOpen) closeModal();
});
