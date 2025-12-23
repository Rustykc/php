<?php
require_once 'config.php';

$conn = connect();
echo "Подключение успешно<br>";

file_put_contents("output_client1.txt", "Подключение успешно\n");

$conn->close();
echo "Соединение закрыто";