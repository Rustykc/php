<?php
require_once 'config.php';
$conn = connect();
$table = "";

if (isset($_POST['sql'])) {
    $sql = trim($_POST['sql']);
    if ($res = $conn->query($sql)) {
        if ($res instanceof mysqli_result) {
            $table .= "<table border='1'><tr>";
            foreach ($res->fetch_fields() as $f) {
                $table .= "<th>{$f->name}</th>";
            }
            $table .= "</tr>";

            while ($row = $res->fetch_row()) {
                $table .= "<tr>";
                foreach ($row as $v) {
                    $table .= "<td>" . htmlspecialchars((string)$v) . "</td>";
                }
                $table .= "</tr>";
            }
            $table .= "</table>";
            $res->free();
        }
    }
}
$conn->close();
?>

<form method="post">
<textarea name="sql" cols="80" rows="6"></textarea><br>
<input type="submit" value="Выполнить SQL">
</form>
<?= $table ?>