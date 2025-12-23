<?php
require_once 'config.php';

$conn = connect();
$sql = "SELECT id_актера, фамилия, имя FROM актер";
$res = $conn->query($sql);

$text = "";
if ($res) {
    while ($row = $res->fetch_row()) {
        $line = implode("\t", $row);
        echo $line . "<br>";
        $text .= $line . "\n";
    }
    $res->free();
}

file_put_contents("output_client4.txt", $text);
$conn->close();