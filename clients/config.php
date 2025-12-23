<?php
const DB_HOST = 'localhost';
const DB_USER = 'root1';
const DB_PASSWORD = '12345678';
const DB_NAME = 'theater';
const DB_CHARSET = 'utf8mb4';

function connect(): mysqli {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }
    $conn->set_charset(DB_CHARSET);
    return $conn;
}
