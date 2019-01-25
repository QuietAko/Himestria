<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';

    echo Structure::getHeader('Химия', 'chemistry');
    ?>

    <div id="main">
        
            <img id="header_icon" src="/chemistry/images/flask.png" width="32px" height="32px" name="flask" title="flask" />
            <h1>Химия</h1>
      
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
        </section>
    </div>
</body>
