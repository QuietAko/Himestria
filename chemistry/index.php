<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';

    echo Structure::getHeader('Химия', 'chemistry');
    ?>

    <div id="main">
        <section>
            <img id="header_icon" src="/chemistry/images/flask.png" width="32px" height="32px" name="flask" title="flask" />
            <h1>Химия</h1>            
        </section>
        <section>
            <h1>Учебные материалы</h1>
            <ul>
                <li><a href="/chemistry/library/stroenie-atoma.rtf">Строение атома (rtf)</a></li>
                <li><a href="/chemistry/library/valentnost.doc">Валентность (doc)</a></li>
                <li><a href="/chemistry/library/stepen-okisleniya.rtf">Степень окисления (rtf)</a></li>
                <li><a href="/chemistry/library/himicheskaya-svyaz.rtf">Химическая связь (rtf)</a></li>
                <li><a href="/chemistry/library/neorganicheskie-soedineniya.rtf">Неорганические соединения (rtf)</a></li>
                <li><a href="/chemistry/library/tablitsa-reaktsiy.rtf">Таблица реакций (rtf)</a></li>
            </ul>
        </section>
        <section>
            <h1>Упражнения</h1>
            <ul>
                <li><a href="/chemistry/tasks/substance_class.php">Класс вещества</a></li>
                <li><a href="/chemistry/tasks/oxide_type.php">Тип оксида</a></li>
                <li><a href="/chemistry/tasks/element_subgroup.php">Подгруппа элемента</a></li>
                <li><a href="/chemistry/tasks/chemical_bond.php">Тип химической связи</a></li>
                <li><a href="/chemistry/tasks/atom_structure.php">Строение атома</a></li>
                <li><a href="/chemistry/tasks/yes_no_questions.php">Вопросы по первому триместру</a></li>
                <li class="standout"><a href="/chemistry/tasks/challenge.php">Контрольный тест</a></li>
            </ul>
        </section>
        <section>
            <h1>Задачи</h1>
            <ul>
                <li><a href="/chemistry/tasks/word_problem.php?type_id=1">Легкий уровень</a></li>
                <li><a href="/chemistry/tasks/word_problem.php?type_id=2">Средний уровень</a></li>
                <!--<li><a href="chemistry/tasks/word_problem.php?type_id=3">Сложный уровень</a></li>-->
            </ul>
        </section>
	<section>
            <h1>Приложения</h1>
            <ul>
                <li><a href="/chemistry/apps/ted-v28.exe">Теория электролитической диссоциации (exe)</a></li>
                <li><a href="/chemistry/apps/snake-v25.exe">Металлическая змейка (exe)</a></li>
                <li><a href="/chemistry/apps/inorganic-compounds-v49.exe">Названия неорганических соединений (exe)</a></li>
            </ul>
        </section>
        <footer>
            Касицкий Андрей Юрьевич
        </footer>
    </div>
</body>