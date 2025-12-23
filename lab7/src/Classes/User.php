<?php
namespace src\Classes;

class User {
    // public $name;
    // public $login;
    // private $password;

    /**
     * Конструктор класса User
     * @param string $name Имя пользователя
     * @param string $login Логин пользователя
     * @param string $password Пароль пользователя
     */
    public function __construct(public string $name, public string $login, private string $password) {
        echo "Пользователь {$this->login} создан<br>";
    }

    public function showInfo(): void {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px;'>";
        echo "<h3>Информация о пользователе:</h3>";
        echo "<p><strong>Имя:</strong> {$this->name}</p>";
        echo "<p><strong>Логин:</strong> {$this->login}</p>";
        echo "<p><strong>Пароль:</strong> ******</p>";
        echo "</div>";
    }

    public function __destruct() {
        echo "Пользователь {$this->login} удален<br>";
    }
}
?>