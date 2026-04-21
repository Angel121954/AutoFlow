<script>
(function () {

    let currentFilter  = 'all';
    let currentTrigger = '';

    function filterAutomations() { applyFilters(); }

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

    function openCreateModal() {
        document.getElementById('af-automation-form').action       = "{{ route('automations.store') }}";
        document.getElementById('af-form-method').value            = 'POST';
        document.getElementById('af-editing-id').value             = '';
        document.getElementById('modal-name').value                = '';
        document.getElementById('modal-description').value         = '';
        document.getElementById('modal-active').checked            = true;
        clearTriggerSelection();
        document.getElementById('af-modal-title').textContent       = 'Nueva automatización';
        document.getElementById('af-modal-subtitle').textContent    = 'Configura un flujo automático';
        document.getElementById('af-modal-submit-text').textContent = 'Crear automatización';
        openModal();
    }

    function openEditModal(data) {
        document.getElementById('af-automation-form').action = `/automations/${data.id}`;
        document.getElementById('af-form-method').value      = 'PUT';
        document.getElementById('af-editing-id').value       = data.id;
        document.getElementById('modal-name').value          = data.name;
        document.getElementById('modal-description').value   = data.description || '';
        document.getElementById('modal-active').checked      = data.active;
        setTriggerSelection(data.trigger_type);
        document.getElementById('af-modal-title').textContent = 'Editar automatización';
        openModal();
    }

    function clearTriggerSelection() {
        document.querySelectorAll('#af-modal-trigger-grid .af-modal-trigger-option').forEach(opt => {
            opt.classList.remove('af-modal-trigger-option--selected');
            opt.querySelector('input').checked = false;
        });
    }

    function setTriggerSelection(value) {
        clearTriggerSelection();
        const el = document.querySelector(`[data-value="${value}"]`);
        if (el) {
            el.classList.add('af-modal-trigger-option--selected');
            el.querySelector('input').checked = true;
        }
    }

    function confirmDelete(id, name) {
        if (confirm(`¿Eliminar "${name}"?`)) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    }

    function runAutomation(id) {
        fetch(`/automations/run/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) throw new Error(data.message || 'Error');
            Swal.fire({ icon: 'success', title: 'Automatización ejecutada', text: data.message });
        })
        .catch(err => {
            Swal.fire({ icon: 'error', title: 'Error', text: err.message });
        });
    }

    // Exponer funciones al HTML (onclick necesita acceso global)
    window.filterAutomations     = filterAutomations;
    window.setFilter             = setFilter;
    window.filterByTrigger       = filterByTrigger;
    window.openCreateModal       = openCreateModal;
    window.openEditModal         = openEditModal;
    window.closeModal            = closeModal;
    window.handleBackdropClick   = handleBackdropClick;
    window.confirmDelete         = confirmDelete;
    window.runAutomation         = runAutomation;
    window.clearTriggerSelection = clearTriggerSelection;
    window.setTriggerSelection   = setTriggerSelection;

    // Reapertura modal si hay errores de validación
    @if($errors->any())
    document.addEventListener('DOMContentLoaded', () => {
        @if(old('editing_id'))
        openEditModal({
            id:           {{ (int) old('editing_id') }},
            name:         {!! json_encode(old('name')) !!},
            description:  {!! json_encode(old('description')) !!},
            trigger_type: {!! json_encode(old('trigger_type')) !!},
            active:       {{ old('active') ? 'true' : 'false' }},
        });
        @else
        openCreateModal();
        document.getElementById('modal-name').value        = {!! json_encode(old('name')) !!};
        document.getElementById('modal-description').value = {!! json_encode(old('description')) !!};
        @endif
    });
    @elseif(request()->query('new'))
    document.addEventListener('DOMContentLoaded', () => openCreateModal());
    @endif

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && _modalOpen) closeModal();
    });

})();
</script>