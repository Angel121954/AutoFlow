/**
 * AutoFlow — swal-flash.js
 * Define el mixin AfToast y dispara los toasts flash de sesión.
 * Lee los datos desde las <meta> del <head>, inyectadas por Blade.
 * Debe cargarse después del CDN de SweetAlert2.
 */

/* global Swal */
const AfToast = Swal.mixin({
    toast             : true,
    position          : 'top-end',
    showConfirmButton : false,
    timer             : 3500,
    timerProgressBar  : true,
    customClass       : { popup: 'af-swal-toast' },
});

window.AfToast = AfToast;

/* ── Leer sesión flash desde las metas del <head> ── */
const flashSuccess = document.querySelector('meta[name="flash-success"]')?.content;
const flashError   = document.querySelector('meta[name="flash-error"]')?.content;

if (flashSuccess) AfToast.fire({ icon: 'success', title: flashSuccess });
if (flashError)   AfToast.fire({ icon: 'error',   title: flashError });
