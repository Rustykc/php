<?php
require_once 'config.php';

$conn = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    $msg = "Ошибка подключения: " . $conn->connect_error;
    echo $msg;
    file_put_contents("output_client2.txt", $msg . "\n");
    exit;
}

echo "Подключение успешно";
file_put_contents("output_client2.txt", "Подключение успешно\n");
$conn->close();