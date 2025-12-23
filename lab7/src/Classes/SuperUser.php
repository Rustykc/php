<?php
namespace src\Classes;

class SuperUser extends User {
    public $role;

    /**
     * Конструктор класса SuperUser
     * @param string $name Имя пользователя
     * @param string $login Логин пользователя
     * @param string $password Пароль пользователя
     * @param string $role Роль пользователя
     */
    public function __construct(string $name, string $login, string $password, string $role) {
        parent::__construct($name, $login, $password);
        $this->role = $role;
    }

    /**
     * Выводит информацию о суперпользователе
     */
    public function showInfo(): void {
        echo "<div style='border: 2px solid #f00; padding: 10px; margin: 10px; background: #ffe6e6;'>";
        echo "<h3>Информация о СУПЕРпользователе:</h3>";
        echo "<p><strong>Имя:</strong> {$this->name}</p>";
        echo "<p><strong>Логин:</strong> {$this->login}</p>";
        echo "<p><strong>Пароль:</strong> ******</p>";
        echo "<p><strong>Роль:</strong> {$this->role}</p>";
        echo "</div>";
    }
}
?>