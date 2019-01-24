<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules_db.inc.php';

    $response = array('result' => STR_UNDEFINED_ERROR);

    try
    {
        $type_id = isset($_GET['type_id']) ? intval($_GET['type_id']) : 1;

        $used_questions = isset($_GET['uq']) ? $_GET['uq'] : array();

        $db = Database::getInstance();

        if (isset($_GET['word_problem']))
        {
            $item = WordProblem::getRandomItemByType($db, $type_id, $used_questions);
        }
        else
        {
            $item = TestTaskItem::getRandomItemByType($db, $type_id, $used_questions);
        }        

        $db->close();

        if (count($item) > 0)
        {
            $response['id'] = $item['id'];
            $response['question'] = $item['question'];
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