<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';

    echo Structure::getHeader('Вопросы', 'chemistry');
	echo Structure::getTask(15);
?>