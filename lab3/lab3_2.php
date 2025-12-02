<?php
declare(strict_types=1);

$now = time();

$hour = (int)date('G');
if ($hour >= 6 && $hour < 12) {
    $welcome = 'Доброе утро';
} elseif ($hour >= 12 && $hour < 18) {
    $welcome = 'Добрый день';
} elseif ($hour >= 18 && $hour < 23) {
    $welcome = 'Добрый вечер';
} else {
    $welcome = 'Доброй ночи';
}

$formattedDate = date("d.m.Y H:i:s");

$currentYear = (int)date('Y');
$birthday = mktime(0, 0, 0, 10, 24, $currentYear);

if ($birthday < $now) {
    $birthday = mktime(0, 0, 0, 10, 24, $currentYear + 1);
}

$secondsLeft = $birthday - $now;
$days = floor($secondsLeft / 86400);
$hours = floor(($secondsLeft % 86400) / 3600);
$minutes = floor(($secondsLeft % 3600) / 60);
$seconds = $secondsLeft % 60;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Использование функций даты и времени</title>
    <style>
        body { font-family: Arial; margin: 20px; line-height: 1.6; }
        .welcome { font-size: 24px; margin-bottom: 20px; color: #2c3e50; }
        .date-info, .birthday-info {
            padding: 15px; border-radius: 5px; margin-bottom: 20px;
        }
        .date-info { background: #f8f9fa; }
        .birthday-info { background: #e8f5e8; }
    </style>
</head>
<body>

<h1>Использование функций даты и времени</h1>

<div class="welcome"><?= $welcome ?></div>

<div class="date-info">
    <strong>Текущая дата и время:</strong><br>
    <?= $formattedDate ?>
</div>

<div class="birthday-info">
    <strong>До моего дня рождения осталось:</strong><br>
    <?= $days ?> дней,
    <?= $hours ?> часов,
    <?= $minutes ?> минут,
    <?= $seconds ?> секунд
</div>

</body>
</html>
