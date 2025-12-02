<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Таблица умножения</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <img src="logo.png" width="130" height="80" alt="Наш логотип" class="logo">
  <span class="slogan">приходите к нам учиться</span>
</header>

<section>
  <h1>Таблица умножения</h1>

  <form action="">
    <label>Количество колонок: </label><br>
    <input name="cols" type="text" value=""><br>

    <label>Количество строк: </label><br>
    <input name="rows" type="text" value=""><br>

    <label>Цвет: </label><br>
    <input name="color" type="color" value="#ff0000" list="listColors">
    <datalist id="listColors">
      <option>#ff0000</option>
      <option>#00ff00</option>
      <option>#0000ff</option>
    </datalist>
    <br><br>

    <input type="submit" value="Создать">
  </form>

  <br>

  <?php
    if (!empty($_GET['cols']) && !empty($_GET['rows'])) {
        $cols = (int)$_GET['cols'];
        $rows = (int)$_GET['rows'];
        $color = $_GET['color'] ?? '#90ee90'; // светло-зеленый по умолчанию

        echo "<table border='1' cellpadding='5'>";
        for ($tr = 1; $tr <= $rows; $tr++) {
            echo "<tr>";
            for ($td = 1; $td <= $cols; $td++) {
                if ($tr == 1 || $td == 1) {
                    echo "<th style='background-color: $color; text-align:center;'>".($td * $tr)."</th>";
                } else {
                    echo "<td>".($td * $tr)."</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    }
  ?>

</section>

<nav>
  <h2>Навигация по сайту</h2>
  <ul>
    <li><a href='index.php'>Домой</a></li>
    <li><a href='about.php'>О нас</a></li>
    <li><a href='contact.php'>Контакты</a></li>
    <li><a href='table.php'>Таблица умножения</a></li>
    <li><a href='calc.php'>Калькулятор</a></li>
  </ul>
</nav>

<footer>
  &copy; Супер Мега Веб-мастер, 2000 – 20xx
</footer>

</body>
</html>
