<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';

    echo Structure::getHeader('Класс вещества', 'chemistry');
	echo Structure::getTask(1);
?>