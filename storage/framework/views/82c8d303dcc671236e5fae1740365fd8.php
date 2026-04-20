

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/modals/automation-modal.css')); ?>">
<?php $__env->stopPush(); ?>

<div class="af-modal-backdrop" id="af-automation-modal">

    <div class="af-modal-box" role="dialog" aria-modal="true" aria-labelledby="af-modal-title">

        
        <div class="af-modal-header">
            <div class="af-modal-header__icon" id="af-modal-icon">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div class="af-modal-header__text">
                <h2 class="af-modal-header__title" id="af-modal-title">Nueva automatización</h2>
                <p class="af-modal-header__subtitle" id="af-modal-subtitle">
                    Configura un flujo automático para tu negocio
                </p>
            </div>
            <button class="af-modal-close" aria-label="Cerrar">
                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        
        <form id="af-automation-form" method="POST" action="<?php echo e(route('automations.store')); ?>" novalidate>
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method"    id="af-form-method" value="POST">
            <input type="hidden" name="editing_id" id="af-editing-id"  value="">

            <div class="af-modal-body">

                
                <?php if($errors->any()): ?>
                    <div class="af-modal-errors">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                
                <div class="af-modal-section">
                    <div class="af-modal-section__header">
                        <span class="af-modal-section__step">1</span>
                        <span class="af-modal-section__title">Información básica</span>
                    </div>
                    <div class="af-modal-section__body">
                        <div class="af-field">
                            <label for="modal-name" class="af-label">
                                Nombre de la automatización
                            </label>
                            <input id="modal-name" type="text" name="name"
                                   value="<?php echo e(old('name')); ?>"
                                   placeholder="Ej: Bienvenida a nuevos usuarios"
                                   required
                                   class="af-input <?php echo e($errors->has('name') ? 'af-input--error' : ''); ?>"/>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="af-field-error"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="af-field af-field--no-mb">
                            <label for="modal-description" class="af-label">
                                Descripción
                                <span class="af-label__optional">(opcional)</span>
                            </label>
                            <textarea id="modal-description" name="description" rows="3"
                                      placeholder="Describe qué hace esta automatización..."
                                      class="af-input af-textarea <?php echo e($errors->has('description') ? 'af-input--error' : ''); ?>"><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="af-field-error"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                
                <div class="af-modal-section">
                    <div class="af-modal-section__header">
                        <span class="af-modal-section__step">2</span>
                        <span class="af-modal-section__title">Tipo de trigger</span>
                    </div>
                    <div class="af-modal-section__body">
                        <p class="af-modal-trigger-hint">¿Qué evento dispara esta automatización?</p>
                        <div class="af-modal-trigger-grid" id="af-modal-trigger-grid">
                            <?php $__currentLoopData = [
                                ['value' => 'email',    'emoji' => '📧', 'label' => 'Email',      'desc' => 'Al recibir correo'],
                                ['value' => 'whatsapp', 'emoji' => '💬', 'label' => 'WhatsApp',   'desc' => 'Mensaje entrante'],
                                ['value' => 'registro', 'emoji' => '👤', 'label' => 'Registro',   'desc' => 'Nuevo usuario'],
                                ['value' => 'pago',     'emoji' => '💳', 'label' => 'Pago',       'desc' => 'Pago completado'],
                                ['value' => 'webhook',  'emoji' => '🔗', 'label' => 'Webhook',    'desc' => 'Llamada HTTP'],
                                ['value' => 'schedule', 'emoji' => '⏰', 'label' => 'Programado', 'desc' => 'A una hora fija'],
                            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="af-modal-trigger-option <?php echo e(old('trigger_type') === $t['value'] ? 'af-modal-trigger-option--selected' : ''); ?>"
                                       data-value="<?php echo e($t['value']); ?>">
                                    <input type="radio" name="trigger_type" value="<?php echo e($t['value']); ?>"
                                           <?php echo e(old('trigger_type') === $t['value'] ? 'checked' : ''); ?> required>
                                    <span class="af-modal-trigger-emoji"><?php echo e($t['emoji']); ?></span>
                                    <span class="af-modal-trigger-label"><?php echo e($t['label']); ?></span>
                                    <span class="af-modal-trigger-desc"><?php echo e($t['desc']); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php $__errorArgs = ['trigger_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="af-field-error"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="af-modal-section">
                    <div class="af-modal-section__header">
                        <span class="af-modal-section__step">3</span>
                        <span class="af-modal-section__title" id="af-modal-status-label">Estado inicial</span>
                    </div>
                    <div class="af-modal-section__body">
                        <div class="af-modal-status-row">
                            <div>
                                <div class="af-modal-status-row__title" id="af-modal-status-title">
                                    Activar al crear
                                </div>
                                <div class="af-modal-status-row__desc" id="af-modal-status-desc">
                                    La automatización comenzará a ejecutarse inmediatamente
                                </div>
                            </div>
                            <label class="af-toggle">
                                <input type="checkbox" name="active" id="modal-active" value="1" checked>
                                <span class="af-toggle-track"><span class="af-toggle-thumb"></span></span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            
            <div class="af-modal-footer">
                <button type="button" class="af-btn af-btn--secondary">
                    Cancelar
                </button>
                <button type="submit" class="af-btn af-btn--primary" id="af-modal-submit">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span id="af-modal-submit-text">Crear automatización</span>
                </button>
            </div>

        </form>
    </div>
</div>
<?php /**PATH C:\laragon\www\AutoFlow\resources\views/components/automation-modal.blade.php ENDPATH**/ ?>