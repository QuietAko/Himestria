<?php

class Structure
{
    private function __construct() {}
    private function __clone() {}

    public static function getHeader($title, $section, $head = '')
    {
        $version = VERSION;
        $base = 'http://' . $_SERVER['HTTP_HOST'] . '/';

return <<<EOD
<!DOCTYPE html>

<head>
    <title>{$title}</title>

    <meta charset="utf-8">    
    <meta name="yandex-verification" content="778a6579fabca99f" />    

    <base href="{$base}">

    <script src="/Js/jquery-3.3.1.js" defer></script>
    <script src="/Js/OwnJs.js"></script>

    <link rel="stylesheet" href="/style.css?{$version}">
    <link href="http://allfont.ru/allfont.css?fonts=roboto-thin" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
    <link rel="stylesheet" href="/Style/MainStyle.css">
    <link rel="stylesheet" href="/Style/Media.css">

    {$head}
</head>
<body class={$section}>

EOD;
    }

    public static function getTask($type_id, $questions_count = 10)
    {
        $version = VERSION;

return <<<EOD

    <canvas id="myCanvas">
	    Ваш браузер не пооддерживает HTML5-тег canvas.
	</canvas>

    <input id="typeId" type="hidden" value="{$type_id}" />
    <input id="questionsCount" type="hidden" value="{$questions_count}" />

    <script type="text/javascript" src="/Js/mymath.class.js"></script>
    <script type="text/javascript" src="/Js/rect.class.js"></script>
	<script type="text/javascript" src="/Js/canvas.class.js"></script>
    <script type="text/javascript" src="/Js/task.class.js"></script>
    <script type="text/javascript" src="/Js/manager.class.js"></script>

	<p align="center"><a href="chemistry/">Главная страница</a></p>
</body>
</html>
EOD;
    }

    public static function getWordProblem($type_id)
    {
        $version = VERSION;

        $type_name = self::getWordProblemTypeName($type_id);

return <<<EOD

    <div id="task">
        <h2 class="header">Задача</h2>
        <h4 class="header">{$type_name}</h4>

        <input id="typeId" type="hidden" value="{$type_id}" />

        <div id="question">...</div>
        <input id="answer" type="text" /><br />
        <input id="check" type="button" value="Проверить ответ" /> <span id="message"></span>

        <script type="text/javascript" src="/Js/word_problem.js?{$version}"></script>

	    <p class="home-link"><a href="chemistry/">Главная страница</a></p>
    </div>
</body>
</html>
EOD;
    } 

    public static function getWordProblemTypeName($type_id)
    {
        $type_name = '';

        switch ($type_id) {
            case 1:
                $type_name = 'Легкий уровень';
                break;
            case 2:
                $type_name = 'Средний уровень';
                break;
            case 3:
                $type_name = 'Сложный уровень';
                break;                
        }

        return $type_name;
    }   
}

?>