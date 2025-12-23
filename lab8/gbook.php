<?php
declare(strict_types=1);

/*
ЗАДАНИЕ 1
- Создайте файл config.php и определите в нём константы DB_NAME, DB_USER, DB_PASSWORD, DB_HOST, DB_CHARSET
- С помощью require_once подключите config.php 
- Подключитесь к серверу MySQL, выберите базу данных
- Установите кодировку по умолчанию для текущего соединения
- 
- Проверьте, была ли корректным образом отправлена форма
- Если она была отправлена: отфильтруйте полученные данные 
  с помощью функций trim(), htmlspecialchars() и mysqli_real_escape_string(),
  сформируйте SQL-оператор на вставку данных в таблицу msgs и выполните его с помощью функции mysqli_query(). 
  После этого с помощью функции header() выполните перезапрос страницы, 
  чтобы избавиться от информации, переданной через форму
*/

/*
ЗАДАНИЕ 3
- Проверьте, был ли запрос методом GET на удаление записи
- Если он был: отфильтруйте полученные данные,
  сформируйте SQL-оператор на удаление записи и выполните его.
  После этого выполните перезапрос страницы, чтобы избавиться от информации, переданной методом GET
*/

// Подключаем конфигурацию базы данных
require_once 'config.php';

/**
 * Подключается к базе данных
 * @return mysqli Объект соединения с БД
 */
function connectToDatabase(): mysqli {
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    if ($connection->connect_error) {
        die("Ошибка подключения к базе данных: " . $connection->connect_error);
    }
    
    // Устанавливаем кодировку
    $connection->set_charset(DB_CHARSET);
    
    return $connection;
}

/**
 * Фильтрует и экранирует строковые данные
 * @param mysqli $connection Соединение с БД
 * @param string $data Данные для фильтрации
 * @return string Отфильтрованные данные
 */
function filterInput(mysqli $connection, string $data): string {
    $data = trim($data);
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $data = $connection->real_escape_string($data);
    return $data;
}

// Подключаемся к базе данных
$connection = connectToDatabase();

// Обработка отправки формы (Задание 1)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['msg'])) {
    // Фильтруем данные
    $name = filterInput($connection, $_POST['name']);
    $email = filterInput($connection, $_POST['email']);
    $msg = filterInput($connection, $_POST['msg']);
    
    // Проверяем, что все поля заполнены
    if (!empty($name) && !empty($email) && !empty($msg)) {
        // Используем правильное имя столбца 'msg'
        $sql = "INSERT INTO msgs (name, email, msg) 
                VALUES ('$name', '$email', '$msg')";
        
        if ($connection->query($sql)) {
            // Перезапрос страницы для избежания повторной отправки формы
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<p style='color: red;'>Ошибка при добавлении сообщения: " . $connection->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Все поля должны быть заполнены!</p>";
    }
}

// Обработка удаления записи (Задание 3)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $deleteId = (int)$_GET['delete_id'];
    
    if ($deleteId > 0) {
        $sql = "DELETE FROM msgs WHERE id = $deleteId";
        
        if ($connection->query($sql)) {
            // Перезапрос страницы для избежания повторного удаления
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<p style='color: red;'>Ошибка при удалении сообщения: " . $connection->error . "</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гостевая книга</title>
    <style>
        .message { 
            border: 1px solid #ccc; 
            margin: 10px 0; 
            padding: 15px; 
            position: relative;
        }
        .delete-link { 
            color: red; 
            position: absolute;
            bottom: 10px;
            right: 15px;
        }
        .message-info { 
            font-size: 0.9em; 
            color: #666; 
            margin-bottom: 10px; 
        }
        .author-link { 
            color: #333; 
            text-decoration: none; 
            font-weight: bold; 
        }
        .author-link:hover { 
            text-decoration: underline; 
            color: #0066cc; 
        }
        .message-text {
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

<h1>Гостевая книга</h1>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    Ваше имя:<br>
    <input type="text" name="name" required><br>
    Ваш E-mail:<br>
    <input type="email" name="email" required><br>
    Сообщение:<br>
    <textarea name="msg" cols="50" rows="5" required></textarea><br>
    <br>
    <input type="submit" value="Добавить!">
</form>

<?php
/*
ЗАДАНИЕ 2
- Сформируйте SQL-оператор на выборку всех данных из таблицы
  msgs в обратном порядке и выполните его. Результат выборки
  сохраните в переменной.
- Закройте соединение с БД
- С помощью функции mysqli_num_rows() получите количество рядов результата выборки и выведите его на экран
- В цикле функцией mysqli_fetch_assoc() получите очередной ряд результата выборки в виде ассоциативного массива.
  Таким образом, используя этот цикл, выведите на экран все сообщения, а также информацию
  об авторе каждого сообщения. После каждого сообщения сформируйте ссылку для удаления этой
  записи. Информацию об идентификаторе удаляемого сообщения передавайте методом GET.
*/

/**
 * Выводит все сообщения из гостевой книги
 * @param mysqli $connection Соединение с БД
 */
function displayMessages(mysqli $connection): void {
    // Формируем SQL запрос на выборку данных в обратном порядке
    $sql = "SELECT * FROM msgs ORDER BY id DESC";
    $result = $connection->query($sql);
    
    if (!$result) {
        echo "<p style='color: red;'>Ошибка при получении сообщений: " . $connection->error . "</p>";
        return;
    }
    
    // Получаем количество сообщений
    $messageCount = $result->num_rows;
    echo "<h2>Сообщения в гостевой книге ($messageCount):</h2>";
    
    if ($messageCount > 0) {
        // Выводим все сообщения в цикле
        while ($row = $result->fetch_assoc()) {
            echo "<div class='message'>";
            echo "<div class='message-info'>";
            // Имя автора как ссылка mailto (при наведении)
            echo "<a href='mailto:" . htmlspecialchars($row['email']) . "' class='author-link' title='Написать письмо на " . htmlspecialchars($row['email']) . "'>";
            echo htmlspecialchars($row['name']);
            echo "</a>";
            echo "</div>";
            echo "<div class='message-text'>";
            echo nl2br(htmlspecialchars($row['msg']));
            echo "</div>";
            // Ссылка для удаления сообщения в правом нижнем углу
            echo "<a class='delete-link' href='" . htmlspecialchars($_SERVER['PHP_SELF']) . 
                 "?delete_id=" . $row['id'] . "' onclick=\"return confirm('Вы уверены, что хотите удалить это сообщение?')\">Удалить</a>";
            echo "</div>";
        }
    } else {
        echo "<p>Пока нет сообщений в гостевой книге.</p>";
    }
    
    // Закрываем результат
    $result->free();
}

// Выводим сообщения
displayMessages($connection);

// Закрываем соединение с БД
$connection->close();
?>

</body>
</html>