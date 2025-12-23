<?php
require_once 'config.php';

$conn = connect();

$sql = "INSERT INTO актер (фамилия, имя) VALUES ('Петров','Петр')";
if ($conn->query($sql)) {
    $msg = "Добавлено строк: " . $conn->affected_rows;
} else {
    $msg = "Ошибка: " . $conn->error;
}

echo $msg;
file_put_contents("output_client3.txt", $msg . "\n");

$conn->close();