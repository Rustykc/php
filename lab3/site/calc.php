<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Калькулятор</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <img src="logo.png" width="130" height="80" alt="Наш логотип" class="logo">
  <span class="slogan">приходите к нам учиться</span>
</header>

<section>
  <h1>Калькулятор школьника</h1>

  <form action="">
    <label>Число 1:</label><br>
    <input name="num1" type="text"><br>

    <label>Оператор (+ - * /):</label><br>
    <input name="operator" type="text"><br>

    <label>Число 2:</label><br>
    <input name="num2" type="text"><br><br>

    <input type="submit" value="Считать">
  </form>

  <br>

  <?php
  if (!empty($_GET['num1']) && !empty($_GET['num2']) && !empty($_GET['operator'])) {
      $a = $_GET['num1'];
      $b = $_GET['num2'];
      $op = $_GET['operator'];

      if (!is_numeric($a) || !is_numeric($b)) {
          echo "<p style='color:red;'>Ошибка: нужно вводить числа.</p>";
      } else {
          $a = (float)$a;
          $b = (float)$b;

          switch ($op) {
              case '+': $result = $a + $b; break;
              case '-': $result = $a - $b; break;
              case '*': $result = $a * $b; break;
              case '/':
                if ($b == 0) {
                    $result = "Ошибка: деление на ноль";
                } else {
                    $result = $a / $b;
                }
                break;
              default:
                $result = "Неизвестный оператор";
          }

          echo "<h3>Результат: $result</h3>";
      }
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
