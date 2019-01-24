<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';

    echo Structure::getHeader('Строение атома', 'chemistry');

    $typeIds = '';

    for ($i = 5; $i <= 14; $i++)
    {
        $typeIds .= $i . ',';
    }

    $typeIds = substr($typeIds, 0, -1);

	echo Structure::getTask($typeIds);
?>