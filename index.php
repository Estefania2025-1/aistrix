<?php
// local/aistrix/index.php.
require(__DIR__ . '/../../config.php');

require_login();                          // Obliga a iniciar sesión.
$context = context_system::instance();    // Contexto de sitio completo.
require_capability('local/aistrix:view', $context);

$PAGE->set_url(new moodle_url('/local/aistrix/index.php'));
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_title(get_string('pluginname', 'local_aistrix'));
$PAGE->set_heading($SITE->fullname);

// Si tu React build ya genera /assets/index.js y /assets/style.css:
$PAGE->requires->css(new moodle_url('/local/aistrix/assets/style.css'));
$PAGE->requires->js(new moodle_url('/local/aistrix/assets/index.js'));

echo $OUTPUT->header();

// Aquí incluyes tu plantilla Mustache, o simplemente:
echo html_writer::div('', 'aistrix-root');   // React montará aquí.

echo $OUTPUT->footer();