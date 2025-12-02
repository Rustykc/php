<?php
declare(strict_types=1);

// адрес, на который будут отправляться письма
$to = 'agerkert022@gmail.com';
$message = '';

// проверяем, отправлена ли форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim(strip_tags($_POST['subject'] ?? 'Без темы'));
    $body = trim(strip_tags($_POST['body'] ?? ''));

    if ($body === '') {
        $message = 'Ошибка: текст письма не может быть пустым!';
    } else {
        // формируем заголовки письма
        $headers = "From: noreply@" . $_SERVER['SERVER_NAME'] . "\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        if (mail($to, $subject, $body, $headers)) {
            $message = 'Письмо успешно отправлено!';
        } else {
            $message = 'Ошибка: письмо не удалось отправить.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контакты</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <img src="logo.png" width="130" height="80" alt="Наш логотип" class="logo">
    <span class="slogan">приходите к нам учиться</span>
</header>

<section>
    <h1>Обратная связь</h1>

    <h3>Адрес</h3>
    <address>123456 Москва, Малый Американский переулок 21</address>

    <h3>Задайте вопрос</h3>
    <form action="" method="post">
        <label>Тема письма:</label><br>
        <input name="subject" type="text" size="50" value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>"><br>

        <label>Содержание:</label><br>
        <textarea name="body" cols="50" rows="10"><?= htmlspecialchars($_POST['body'] ?? '') ?></textarea><br><br>

        <input type="submit" value="Отправить">
    </form>

    <?php
    if (!empty($message)) {
        echo "<p>$message</p>";
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
    &copy; Супер Мега Веб-мастер, 2000 – <?= date('Y') ?>
</footer>

</body>
</html>
