<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';

    echo Structure::getHeader('Тип химической связи', 'chemistry');
	echo Structure::getTask(4);
?>