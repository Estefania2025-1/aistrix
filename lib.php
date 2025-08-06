<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Registra los assets de Aistrix
 * (debe ejecutarse ANTES de que se imprima <head>).
 */
function local_aistrix_require_assets(): void {
    global $PAGE;

    static $added = false;
    if ($added) {
        return;
    }
    $added = true;

    $PAGE->requires->css('/local/aistrix/amd/build/local_aistrix.css');
    $PAGE->requires->js_call_amd('local_aistrix/main', 'init');
}

/**
 * Callback TEMPRANO: Moodle lo llama antes de cerrar el <head>.
 * Aquí solo encolamos los assets.
 */
function local_aistrix_before_standard_html_head(): void {
    // Opcional: restringir a usuarios con permiso para no cargar nada a invitados.
    if (!has_capability('local/aistrix:view', context_system::instance())) {
        return;
    }
    local_aistrix_require_assets();
}

/**
 * Callback TARDE: Moodle lo llama antes de </footer>.
 * Solo inserta el panel (el CSS y JS ya están listos).
 *
 * @return string  HTML del panel, o '' si el usuario no tiene permiso.
 */
function local_aistrix_before_footer(): string {
    global $OUTPUT;

    if (!has_capability('local/aistrix:view', context_system::instance())) {
        return '';
    }

    // El helper ya corrió; no necesitamos llamar de nuevo.
    $panel = new \local_aistrix\output\panel();
    return $OUTPUT->render($panel);
}
