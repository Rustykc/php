<?php

declare(strict_types=1);
?>
<?php

$cols = 10;
$rows = 10;
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Таблица умножения</title>
	<style>
		table {
			border: 2px solid black;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 10px;
			border: 1px solid black;
		}

		th {
			background-color: yellow;
		}
	</style>
</head>

<body>
	<h1>Таблица умножения</h1>
	<?php
		echo "<table>";
		echo "<tr>";
		for ($j = 1; $j <= $cols; $j++) {
			echo "<th class='header-cell'>" . $j . "</th>";
		}
		echo "</tr>";

		for ($i = 2; $i <= $rows; $i++) {
			echo "<tr>";
			echo "<th class='header-cell'>" . $i . "</th>";

			for ($j = 2; $j <= $cols; $j++) {
				echo "<td>" . ($i * $j) . "</td>";
			}
			echo "</tr>";
		}

		echo "</table>";
	?>
</body>

</html>