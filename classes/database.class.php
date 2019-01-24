<?php

class Database
{
    private static $db = null;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance()
    {
        if (is_null(static::$db))
        {
            static::connect('utf8', 'ru_RU');            
        }

        return static::$db;
    }

    private static function connect($charset, $language)
    {
        static::$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        static::$db->query('SET NAMES ' . $charset);
        static::$db->query("SET lc_time_names = '" . $language . "'");

	    if (static::$db->connect_errno != 0)
        {
	        throw MyException::dbConnectError(static::$db, __METHOD__);
        }
    }
}

?>