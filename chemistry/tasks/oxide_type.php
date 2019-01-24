<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';

    echo Structure::getHeader('Тип оксида', 'chemistry');
	echo Structure::getTask(2);
?>