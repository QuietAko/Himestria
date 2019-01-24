<?php

class TestTask
{
    private function __construct() {}
    private function __clone() {}

    public static function selectById($db, $id)
    {
        $result = array('id' => $id);

        $query = 'SELECT question FROM test_task WHERE id = ? LIMIT 1';

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->bind_result($question);			
			$stmt->store_result();

            if ($stmt->num_rows != 0)
            {
                $stmt->fetch();

                $result['question'] = stripslashes($question);
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

            $result['variants'] = self::getVariants($db, $id);
        }
        else
        {
            throw new MyException(SELECT_QUERY_ERROR, __METHOD__, $query);
        }

        return $result;
    }

    private static function getVariants($db, $type_id)
    {
        $result = array();

        $query = 'SELECT variant FROM test_task_variant WHERE type_id = ?';

        if ($stmt = $db->prepare($query))
        {
            $stmt->bind_param('i', $type_id);
            $stmt->execute();
            $stmt->bind_result($variant);
            $stmt->store_result();

            while ($stmt->fetch())
            {
                $result[] = $variant;
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