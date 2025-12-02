<?php

declare(strict_types=1);

spl_autoload_register(function ($className) {
    $filePath = str_replace('MyProject\\Classes\\', 'MyProject/Classes/', $className) . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
        return true;
    }
    return false;
});

use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

echo "<h1>Работа с классами</h1>";

echo "<h2>Пользователи-User:</h2>";
$user1 = new User("Алексей Михеевич", "alex", "password123");
$user2 = new User("Мира Александровна", "mira", "password456");
$user3 = new User("Арина Николаевна", "arri", "password789");

$user1->showInfo();
$user2->showInfo();
$user3->showInfo();

echo "<h2>Суперпользователь-SuperUser:</h2>";
$user = new SuperUser("Администратор", "admin", "superadmin", "администратор");

$user->showInfo();

echo "<p>Скрипт завершен. Объекты будут удалены автоматически.</p>";