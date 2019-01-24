<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules_db.inc.php';

    try
    {
        $type_id = isset($_GET['type_id']) ? intval($_GET['type_id']) : 1;

        $type_name = Structure::getWordProblemTypeName($type_id);

        echo Structure::getHeader('Задача — ' . $type_name, 'chemistry');
        echo Structure::getWordProblem($type_id);
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
?>