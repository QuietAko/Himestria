<?php

class TaskItem
{
    private function __construct() {}
    private function __clone() {}

    protected static $table_name = '';

    public static function selectById($db, $id)
    {
        $result = array('id' => $id);

        $query = 'SELECT question, answer FROM ' . static::$table_name . ' WHERE id = ? LIMIT 1';

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->bind_result($question, $answer);			
			$stmt->store_result();

            if ($stmt->num_rows != 0)
            {
                $stmt->fetch();

                $result['question'] = stripslashes($question);
                $result['answer'] = $answer;
            }
            else
            {
                throw new MyException(ITEM_NOT_FOUND);
            }

            if ($stmt->errno != 0)
            {
                throw MyException::stmtError($stmt, __METHOD__, $query);
            }               

            $stmt->close();
        }
        else
        {
            throw new MyException(SELECT_QUERY_ERROR, __METHOD__, $query);
        }

        return $result;
    }

    public static function getRandomItemByType($db, $type_id, $used_items)
    {
        $random_item = array();

        $ids = static::getItemsByType($db, $type_id);       
        $ids_count = count($ids);        

        if ($ids_count > 0)
        {
            $random_id = -1;

            $used_items[-1] = true;
            $used_items_count = count($used_items);

            if ($used_items_count <= $ids_count)
            {
                while (array_key_exists($random_id, $used_items))
                {
                    $rnd = rand(0, $ids_count - 1);
                    $random_id = $ids[$rnd];
                }
            }

            $random_item = static::selectById($db, $random_id);
        }        

        return $random_item;
    }

    private static function getItemsByType($db, $type_id)
    {
        $result = array();

        $query = 'SELECT id FROM ' . static::$table_name . ' WHERE type_id = ?';

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param('i', $type_id);
            $stmt->execute();
            $stmt->bind_result($id);
            $stmt->store_result();

            while ($stmt->fetch())
            {
                $result[] = $id;
            }

            if ($stmt->errno != 0)
            {
                throw MyException::stmtError($stmt, __METHOD__, $query);
            }

	        $stmt->close();
        }
        else
        {
            throw new MyException(SELECT_QUERY_ERROR, __METHOD__, $query);
        }

        return $result;
    }    
}

?>