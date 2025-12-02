<?php
require_once 'inc/lib.inc.php';
require_once 'inc/data.inc.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <h1>добро пожаловать на наш сайт!</h1>
  <!-- Заголовок -->

  <!-- Основной контент -->
  <?php include 'inc/index.inc.php'; ?>
  <!-- Основной контент -->
</section>

<nav>
  <!-- Навигация -->
  <h2>навигация по сайту</h2>
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
