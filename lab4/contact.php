<?php
declare(strict_types=1);

$message = '';
$toEmail = 'agerkert022@gmail.com';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // получаем и фильтруем данные формы
    $subject = trim(strip_tags($_POST['subject'] ?? 'Без темы'));
    $body = trim(strip_tags($_POST['body'] ?? ''));

    if ($body === '') {
        $message = 'Ошибка: текст письма не может быть пустым!';
    } else {
        
        $headers = "From: noreply@" . $_SERVER['SERVER_NAME'] . "\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        if (mail($toEmail, $subject, $body, $headers)) {
            $message = 'Письмо успешно отправлено!';
        } else {
            $message = 'Ошибка: письмо не удалось отправить.';
        }
    }
}
?>

<h3>Адрес</h3>
<address>123456 Москва, Малый Американский переулок 21</address>
<h3>Задайте вопрос</h3>

<form action="" method="post">
    <label>Тема письма: </label><br>
    <input name="subject" type="text" size="50" value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>"><br>

    <label>Содержание: </label><br>
    <textarea name="body" cols="50" rows="10"><?= htmlspecialchars($_POST['body'] ?? '') ?></textarea><br><br>

    <input type="submit" value="Отправить">
</form>

<?php
if (!empty($message)) {
    echo "<p>$message</p>";
}
?>
