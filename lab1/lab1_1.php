<?php
$name = 'Валерия';
$age = 20;
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Переменные и вывод</title>
</head>

<body>
	<h1>Переменные и вывод</h1>
		Меня зовут: <?= $name ?> <br>
		Мне <?= $age ?> лет <br>
		Тип переменной $name: <?= gettype($name) ?> <br>
		Тип переменной $age: <?= gettype($age)?> <br>
<?php unset($name, $age); ?>
</body>

</html>