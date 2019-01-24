<?php

class MyLog
{
    public function __construct($message, $method_name = '', $log_file = 'errors.log')
    {
        if ($file_pointer = fopen(ROOT . '/' . $log_file, 'a'))
        {
            $log_text = '[' . MyDate::get_current_time() . '] ' . $_SERVER['SCRIPT_NAME'] . ' --> ' . $method_name . PHP_EOL;
            $log_text .= $message . PHP_EOL . PHP_EOL;

	        fwrite($file_pointer, $log_text);
	        fclose($file_pointer);
        }

        //error_log($log_text);
    }
}

?>