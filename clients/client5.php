<?php
require_once 'config.php';
$conn = connect();
$result = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sql'])) {
    $sql = trim($_POST['sql']);
    if ($res = $conn->query($sql)) {
        if ($res instanceof mysqli_result) {
            while ($row = $res->fetch_row()) {
                $line = implode("\t", $row);
                $result .= $line . "\n";
            }
            $res->free();
        } else {
            $result = "Затронуто строк: " . $conn->affected_rows;
        }
    } else {
        $result = "Ошибка: " . $conn->error;
    }
    file_put_contents("output_client5.txt", $result . "\n", FILE_APPEND);
}
$conn->close();
?>

<form method="post">
<textarea name="sql" cols="80" rows="6"></textarea><br>
<input type="submit" value="Выполнить SQL">
</form>
<pre><?= htmlspecialchars($result) ?></pre>