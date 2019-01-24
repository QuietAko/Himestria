<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';

    echo Structure::getHeader('Контрольный тест', 'chemistry');

    $typeIds = '';
    
    for ($i = 1; $i <= 15; $i++)
    {
        $typeIds .= $i . ',';
    }

    $typeIds = substr($typeIds, 0, -1);

	echo Structure::getTask($typeIds, 20);
?>