<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/include/modules.inc.php';

    echo Structure::getHeader('Главная', 'chemistry');
    ?>
  <body>
    <header>
      <nav class="dws-menu">
        <input type="checkbox" name="toggle"id="menu" class="toggleMenu">
        <label for="menu" class="toggleMenu"><i class="fa fa-bars fa-2x"> Меню</i></label>
        <ul>
          <li>

            <input type="checkbox" name="toggle" class="toggleSubmenu" id="sub_m1">
            <a class="mainHref" href="/"><i class="fa fa-home"></i>Главная</a>
            <label for="sub_m1"class="toggleSubmenu"></label>
        <ul>
          <li>
            <a class="mainHref" href="/LinkMenu/Onas.php">О нас</a></li>
            <li><a class="mainHref" href="/LinkMenu/SaitAbout.php">О сайте</a></li>
            <li><a class="mainHref" href="\LinkMenu\Money\Pozhertvovanie.php">Пожертвовать</a></li>
        </ul>
          </li>
            <li>
            <li>
            <input type="checkbox" name="toggle" class="toggleSubmenu" id="sub_m2">
            <a class="mainHref" href="#"><i class="fa fa-file-signature"></i>Тесты</a>
            <label for="sub_m2"class="toggleSubmenu"></label>
        <ul>
            <li><a href="#" class="mainHref">До школьные</a></li>
            <li><a href="#" class="mainHref">7-8 класс</a></li>
            <li><a href="#" class="mainHref">9 класс</a></li>
            <li><a href="#" class="mainHref">Тест генератор</a></li>
        </ul>
            </li>
            <li>
            <input type="checkbox" name="toggle" class="toggleSubmenu" id="sub_m3">
            <a class="mainHref" href="#"><i class="fa fa-download"></i>Файлы</a>
            <label for="sub_m3"class="toggleSubmenu"></label>
         <ul>
            <li><a href="/LinkMenu/SpravoshniyMaterial.php" class="mainHref">Справочный материал</a></li>

            <li>
              <input type="checkbox" name="toggle" class="toggleSubmenu" id="sub_m3-KR">
              <a href="#" class="mainHref">Контрольные работы</a><label for="sub_m3-KR"class="toggleSubmenu"></label>
              <label for="sub_m3-KR"class="toggleSubmenu"></label>

          <ul>
            <li><a href="#" class="mainHref">Сложные</a></li>
            <li><a href="#" class="mainHref">Легкие</a></li>
          </ul>
            </li>

                <li>
                  <input type="checkbox" name="toggle" class="toggleSubmenu" id="sub_m3-SR">
                  <a href="#" class="mainHref">Самостоятельные работы</a>
                  <label for="sub_m3-SR"class="toggleSubmenu"></label>
                 <ul>
                    <li><a href="#" class="mainHref">Сложные</a></li>
                    <li><a href="#" class="mainHref">Легкие</a></li>
                  </ul>
                </li>
                <li><a href="./DownLoadPage/1.php" class="mainHref">Страница скачивания</a></li>
              </ul>
            </li>
            <li>
              <input type="checkbox" name="toggle" class="toggleSubmenu" id="sub_m4">
              <a class="mainHref" href="#"><i class="fa fa-images"></i>Медиа</a>
              <label for="sub_m4"class="toggleSubmenu"></label>
              <ul>
                <li><a href="#" class="mainHref">Фото веществ</a></li>
                <li><a href="#" class="mainHref">Видео опыты</a></li>
              </ul>
            </li>
            <li>
              <input type="checkbox" name="toggle" class="toggleSubmenu" id="sub_m5">
              <a class="mainHref" href="#"><i class="fa fa-gamepad"></i>Игры</a>
              <label for="sub_m5"class="toggleSubmenu"></label>
              <ul>
                <li><a href="/LinkMenu/GamesDownload.php" class="mainHref">Скачать игры</a></li>
                <li><a href="#" class="mainHref">Поиграть онлайн</a></li>
                <li><a href="#" class="mainHref">F.A.Q по играм</a></li>
              </ul>
            </li>
          </ul>
        </nav>
    </header>
  </body>
</html>
