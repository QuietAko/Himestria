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
    <div class="Hrefs">
      <a target="_blank" class="BittlyHref" href="http://bit.ly/XimikalSnakeZ">Химическая змейка</a><i class="fa fa-snake fa-2x"></i><br>
      <a target="_blank" class="BittlyHref" href="http://bit.ly/Pacanchik">Пацанчик</a><i class="fa fa-child fa-2x"></i><br>
      <a target="_blank" class="BittlyHref" href="http://bit.ly/NeorganicheskieSoed">Неорганические соединения</a><i class="fa fa-skull-crossbones fa-2x"></i><br>
      <a target="_blank" class="BittlyHref" href="http://bit.ly/TED_N">T.Э.Д.</a><i class="fa fa-atom fa-2x"></i>
    </div>
  </body>
</html>
<style>
  .fa-snake, .fa-child, .fa-skull-crossbones, .fa-atom{
    color: #81b931;
    padding: 0 10px 20px;
  }
  .Hrefs {
    z-index: -10;
  }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mo-js/0.288.2/mo.min.js" charset="utf-8"></script>
<script type="text/javascript">
const links = document.querySelectorAll('.BittlyHref');

links.forEach(link => link.addEventListener('mouseenter', shootLines));

function shootLines(e) {

  const itemDim = this.getBoundingClientRect(),
        itemSize = {
          x: itemDim.right - itemDim.left,
          y: itemDim.bottom - itemDim.top,
        },
        shapes = ['line', 'zigzag', 'circle'],
        colors = ['#2FB5F3',
                  '#FF0A47',
                  '#FF0AC2',
                  '#47FF0A',
                  '#0db4f4',
                  '#29e3a1'];

  const chosenC = Math.floor(Math.random() * colors.length),
        chosenS = Math.floor(Math.random() * shapes.length);

  // create shape
  const burst = new mojs.Burst({
    left: itemDim.left + (itemSize.x/2),
    top: itemDim.top + (itemSize.y/2),
    radiusX: itemSize.x,
    radiusY: itemSize.y,
    count: 8,

    children: {
      shape: shapes[chosenS],
      radius:8,
      scale: {0.8: 1},
      fill: 'none',
      points: 8,
      stroke: colors[chosenC],
      strokeDasharray: '100%',
      strokeDashoffset: { '-100%' : '100%' },
      duration: 350,
      delay: 100,
      easing: 'quad.out',
      isShowEnd: false,
    }
  });

  burst.play();
}
</script>
