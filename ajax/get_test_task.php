<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules_db.inc.php';

    $response = array('result' => STR_UNDEFINED_ERROR);

    try
    {
        $type_id = isset($_GET['type_id']) ? intval($_GET['type_id']) : 1;

        $db = Database::getInstance();

        $item = TestTask::selectById($db, $type_id);        

        $db->close();

        if (count($item) > 0)
        {
            $response['question'] = $item['question'];
            $response['variants'] = $item['variants'];
            $response['result'] = 'success';
        }
        else
        {
            $response['result'] = 'Нет задач заданного типа.';
        }
    }
    catch (Exception $e)
    {
        $response = array('result' => $e->getMessage());
    }

    echo json_encode($response);
?>