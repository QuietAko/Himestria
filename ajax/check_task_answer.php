<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules_db.inc.php';

    $response = array('result' => STR_UNDEFINED_ERROR);

    try
    {
        if (!isset($_GET['id']) || !isset($_GET['answer']))
        {
            throw new MyException(UNDEFINED_PARAMS_ERROR);
        }

        $id = intval($_GET['id']);        

        $db = Database::getInstance();        

        if (isset($_GET['word_problem']))
        {
            $answer = floatval($_GET['answer']);
            $item = WordProblem::selectById($db, $id);
        }
        else
        {
            $answer = intval($_GET['answer']);
            $item = TestTaskItem::selectById($db, $id);
        }

        $db->close();

        if (count($item) > 0)
        {
            if ($answer === $item['answer'])
            {
                $response['correct'] = true;   
            }
            else
            {
                $response['correct'] = false;
            }

            $response['result'] = 'success';
        }
        else
        {
            $response['result'] = 'Задача не найдена.';
        }                        
    }
    catch (Exception $e)
    {
        $response = array('result' => $e->getMessage());
    }

    echo json_encode($response);
?>