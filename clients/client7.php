<?php
require_once 'config.php';
$conn = connect();
$out = "";

if (isset($_POST['sql'])) {
    $sql = trim($_POST['sql']);
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res) {
            while ($row = $res->fetch_row()) {
                $line = implode("\t", $row);
                $out .= $line . "\n";
            }
            $res->free();
        }
        $stmt->close();
    } else {
        $out = "Ошибка prepare: " . $conn->error;
    }
    file_put_contents("output_client7.txt", $out . "\n", FILE_APPEND);
}
$conn->close();
?>

<form method="post">
<textarea name="sql" cols="80" rows="6"></textarea><br>
<input type="submit" value="Выполнить SQL (prepared)">
</form>
<pre><?= htmlspecialchars($out) ?></pre>