<?php
declare(strict_types=1);

$cols = 7;
$rows = 4;
$color = '#4fa1ffff';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cols']) && $_POST['cols'] !== '') {
        $cols = abs((int) $_POST['cols']);
        if ($cols === 0) $cols = 1;
    }
    if (isset($_POST['rows']) && $_POST['rows'] !== '') {
        $rows = abs((int) $_POST['rows']);
        if ($rows === 0) $rows = 1;
    }
    if (isset($_POST['color']) && $_POST['color'] !== '') {
        $color = trim(strip_tags((string) $_POST['color']));
    }
}
?>
<!-- Область основного контента -->
<h3>Таблица умножения</h3>

<form action="<?= htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES) ?>" method="post">
  <label>Количество колонок: </label>
  <br>
  <input name="cols" type="number" min="1" value="<?= htmlspecialchars((string)$cols, ENT_QUOTES) ?>">
  <br>
  <label>Количество строк: </label>
  <br>
  <input name="rows" type="number" min="1" value="<?= htmlspecialchars((string)$rows, ENT_QUOTES) ?>">
  <br>
  <label>Цвет: </label>
  <br>
  <input name="color" type="color" value="<?= htmlspecialchars($color, ENT_QUOTES) ?>" list="listColors">
  <datalist id="listColors">
      <option>#4fa1ffff</option>
      <option>#ff0000</option>
      <option>#00ff00</option>
      <option>#0000ff</option>
  </datalist>
  <br><br>
  <input type="submit" value="Создать">
</form>

<br>

<?php
  getTable($rows, $cols, $color);
?>
