<?php
	$age = rand();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Конструкции if-elseif-else</title>
</head>

<body>
	<h1>Конструкции if-elseif-else</h1>
	<?php
		if ($age >= 18 and $age <= 59) {
			echo "Вам ещё работать и работать";
		} elseif ($age > 59) {
			echo "Вам пора на пенсию";
		} elseif ($age >= 1 and $age <= 17) {
			echo "Вам ещё рано работать";
		} else {
			echo "Неизвестный возраст";
		}
	?>
</body>

</html>