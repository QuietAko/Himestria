<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';

    echo Structure::getHeader('Подгруппа элемента', 'chemistry');
	echo Structure::getTask(3);
?>