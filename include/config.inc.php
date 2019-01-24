<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    mb_internal_encoding('UTF-8');

    define('CURRENT_TIMEZONE', 'Europe/Moscow');
    date_default_timezone_set(CURRENT_TIMEZONE);

    define('ROOT', $_SERVER['DOCUMENT_ROOT']);

    define('VERSION', 9);

    define('PT_MONO_FONT', '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Mono">');
?>