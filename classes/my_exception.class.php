<?php

define('DATABASE_CONNECT_ERROR', 0);
define('DATABASE_QUERY_ERROR', 1);
define('UNDEFINED_PARAMS_ERROR', 2);
define('UNEXPECTED_PARAM_VALUE', 3);
define('SELECT_QUERY_ERROR', 4);
define('INSERT_QUERY_ERROR', 5);
define('UPDATE_QUERY_ERROR', 6);
define('DELETE_QUERY_ERROR', 7);
define('QUERY_EXECUTION_ERROR', 8);
define('ITEM_NOT_FOUND', 9);

define('STR_UNDEFINED_ERROR', 'Произошла ошибка. Повторите попытку позже.');
define('STR_DATABASE_CONNECT_ERROR', 'Не удалось подключиться к базе данных. Повторите попытку позже.');
define('STR_DATABASE_QUERY_ERROR', 'Не удалось отправить запрос к базе данных. Повторите попытку позже.');
define('STR_PARAMS_ERROR', 'Не хватает параметров для выполнения запроса.');
define('STR_UNEXPECTED_VALUE', 'Неожиданное значение параметра.');
define('STR_DATA_ERROR', 'Не удалось загрузить данные. Повторите попытку позже.');
define('STR_OPERATION_ERROR', 'Не удалось выполнить операцию. Повторите попытку позже.');
define('STR_ITEM_NOT_FOUND', 'Нет записи с указанным ID.');

class MyException extends Exception
{
    private $error_number = 0;

    public function __construct($error, $method_name = '', $log_message = '', $user_message = '')
    {
        if (is_string($error))
        {
            $log_message = '';
            $user_message = $error;            
        }
        else
        {
            $this->error_number = $error;

            switch ($error)
            {
                case DATABASE_CONNECT_ERROR:
                    $user_message = STR_DATABASE_CONNECT_ERROR;
                    $log_message = 'DATABASE_CONNECT_ERROR: ' . $log_message;
                    break;
                case DATABASE_QUERY_ERROR:
                    $user_message = STR_DATABASE_QUERY_ERROR;
                    $log_message = 'DATABASE_QUERY_ERROR: ' . $log_message;
                    break;
                case UNDEFINED_PARAMS_ERROR:
                    $user_message = STR_PARAMS_ERROR;
                    $log_message = '';
                    break;
                case UNEXPECTED_PARAM_VALUE:
                    $user_message = STR_UNEXPECTED_VALUE;
                    $log_message = 'UNEXPECTED_PARAM_VALUE: ' . $log_message;
                    break;
                case SELECT_QUERY_ERROR:
                    $user_message = STR_DATA_ERROR;
                    $log_message = 'SELECT_QUERY_ERROR: ' . $log_message;
                    break;
                case INSERT_QUERY_ERROR:
                    $user_message = STR_OPERATION_ERROR;
                    $log_message = 'INSERT_QUERY_ERROR: ' . $log_message;
                    break;
                case UPDATE_QUERY_ERROR:
                    $user_message = STR_OPERATION_ERROR;
                    $log_message = 'UPDATE_QUERY_ERROR: ' . $log_message;
                    break;
                case DELETE_QUERY_ERROR:
                    $user_message = STR_OPERATION_ERROR;
                    $log_message = 'DELETE_QUERY_ERROR: ' . $log_message;
                    break;
                case QUERY_EXECUTION_ERROR:
                    $user_message = STR_OPERATION_ERROR;
                    $log_message = 'QUERY_EXECUTION_ERROR: ' . $log_message;
                    break;              
                default:
                    $log_message = 'UNKNOWN_ERROR: ' . $log_message;
            }
        }

        if ($log_message != '')
        {
            new MyLog($log_message, $method_name);
        }

        parent::__construct($user_message);
    }

    public static function dbConnectError($db, $method_name)
    {
        $log_message = $db->connect_errno . ' ' . $db->connect_error;

        $instance = new self(DATABASE_CONNECT_ERROR, $method_name, $log_message);

        return $instance;
    }

    public static function dbQueryError($db, $method_name)
    {
        $log_message = $db->errno . ' ' . $db->error;

        $instance = new self(DATABASE_QUERY_ERROR, $method_name, $log_message);

        return $instance;
    }

    public static function stmtError($stmt, $method_name, $query)
    {
        $log_message = $stmt->errno . ' ' . $stmt->error . '; ' . $query;

        $instance = new self(QUERY_EXECUTION_ERROR, $method_name, $log_message);

        return $instance;
    }
}

?>