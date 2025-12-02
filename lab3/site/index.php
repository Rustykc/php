<?php
  require_once 'inc/lib.inc.php';
  require_once 'inc/data.inc.php';
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Сайт нашей школы</title>
    <link rel="stylesheet" href="style.css">
  </head>
<body>

<header>
  <!-- Верхняя часть страницы -->
  <?php include 'inc/top.inc.php'; ?>
  <!-- Верхняя часть страницы -->
</header>

<section>
  <!-- Заголовок -->
  <h1>Добро пожаловать на наш сайт!</h1>
  <!-- Заголовок -->

  <!-- Область основного контента -->
  <?php include 'inc/index.inc.php'; ?>
  <!-- Область основного контента -->
</section>

<nav>
  <!-- Навигация -->
  <?php include 'inc/menu.inc.php'; ?>
  <!-- Навигация -->
</nav>

<footer>
  <!-- Нижняя часть страницы -->
  <?php include 'inc/bottom.inc.php'; ?>
  <!-- Нижняя часть страницы -->
</footer>

</body>
</html>
