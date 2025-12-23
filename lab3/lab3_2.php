<?php
declare(strict_types=1);

function DateTime(): array
{
    $now = time();
    $currentYear = (int)date('Y');

    $birthday = mktime(0, 0, 0, 10, 24, $currentYear);

    // если день рождения уже прошёл, ставим на следующий год
    if ($birthday < $now) {
        $birthday = mktime(0, 0, 0, 10, 24, $currentYear + 1);
    }

    $Date = getdate();
    $hour = $Date['hours'];

    return [
        'now' => $now,
        'birthday' => $birthday,
        'hour' => $hour
    ];
}

function getMessage(int $hour): string
{
    if ($hour >= 0 && $hour < 6) {
        return 'Доброй ночи';
    } elseif ($hour >= 6 && $hour < 12) {
        return 'Доброе утро';
    } elseif ($hour >= 12 && $hour < 18) {
        return 'Добрый день';
    } elseif ($hour >= 18 && $hour <= 23) {
        return 'Добрый вечер';
    } else {
        return 'Доброй ночи';
    }
}

function formatRussianDate(int $timestamp): string
{
    $months = [
        1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля',
        5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа',
        9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря'
    ];

    $daysOfWeek = [
        'воскресенье', 'понедельник', 'вторник', 'среда',
        'четверг', 'пятница', 'суббота'
    ];

    $date = getdate($timestamp);
    $day = $date['mday'];
    $month = $months[$date['mon']];
    $year = $date['year'];
    $dayOfWeek = $daysOfWeek[$date['wday']];
    $time = date('H:i:s', $timestamp);

    return "Сегодня $day $month $year года, $dayOfWeek $time";
}


//  Расчёт времени до дня рождения

function getBirthday(int $now, int $birthday): array
{
    $secondsLeft = $birthday - $now;

    $days = floor($secondsLeft / (60 * 60 * 24));
    $hours = floor(($secondsLeft % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($secondsLeft % (60 * 60)) / 60);
    $seconds = $secondsLeft % 60;

    return [
        'days' => $days,
        'hours' => $hours,
        'minutes' => $minutes,
        'seconds' => $seconds
    ];
}

$data = DateTime();
$now = $data['now'];
$birthday = $data['birthday'];
$hour = $data['hour'];

$welcome = getMessage($hour);
$formattedDate = formatRussianDate($now);
$timeUntilBirthday = getBirthday($now, $birthday);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Использование функций даты и времени</title>
</head>

<body>
    <h1><?= $welcome ?></h1>

    <p>
        <b>Текущая дата и время:</b><br>
        <?= $formattedDate ?>
    </p>

    <p>
        <b>До моего дня рождения осталось:</b><br>
        <?= $timeUntilBirthday['days'] ?> дней,
        <?= $timeUntilBirthday['hours'] ?> часов,
        <?= $timeUntilBirthday['minutes'] ?> минут,
        <?= $timeUntilBirthday['seconds'] ?> секунд
    </p>
</body>

</html>
