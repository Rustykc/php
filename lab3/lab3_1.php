<?php
declare(strict_types=1);

function initializeVariables(): array
{
    $login = ' User ';
    $password = 'megaP@ssw0rd';
    $name = 'иван';
    $email = 'ivan@petrov.ru';
    $code = '<?=$login?>';
    
    return [
        'login' => $login,
        'password' => $password,
        'name' => $name,
        'email' => $email,
        'code' => $code
    ];
}

function isPasswordStrong(string $password): bool
{
    if (strlen($password) < 8) {
        return false;
    }
    
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }
    
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }
    
    return true;
}

function processData(array $variables): array
{
    $results = [];
    
    $results['login'] = strtolower(trim($variables['login']));
    
    $results['password_strength'] = isPasswordStrong($variables['password']);
    
    $results['name'] = mb_convert_case($variables['name'], MB_CASE_TITLE, 'UTF-8');
    
    $results['email_valid'] = filter_var($variables['email'], FILTER_VALIDATE_EMAIL) !== false;
    
    $results['code'] = htmlspecialchars($variables['code']);
    
    return $results;
}

$variables = initializeVariables();
$results = processData($variables);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Использование функций обработки строк</title>
    <style>
        .result {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <h1>Использование функций обработки строк</h1>
    
    <?php
   
    ?>
    
    <div class="result">
        <h3>Исходные данные:</h3>
        <p>Логин: '<?= htmlspecialchars($variables['login']) ?>'</p>
        <p>Пароль: '<?= htmlspecialchars($variables['password']) ?>'</p>
        <p>Имя: '<?= htmlspecialchars($variables['name']) ?>'</p>
        <p>Email: '<?= htmlspecialchars($variables['email']) ?>'</p>
        <p>Код: '<?= htmlspecialchars($variables['code']) ?>'</p>
    </div>
    
    <div class="result <?= $results['password_strength'] ? 'success' : 'error' ?>">
        <h3>Результаты обработки:</h3>
        <p>Обработанный логин: '<?= htmlspecialchars($results['login']) ?>'</p>
        <p>Сложность пароля: <?= $results['password_strength'] ? 'Соответствует требованиям' : 'Не соответствует требованиям' ?></p>
        <p>Обработанное имя: '<?= htmlspecialchars($results['name']) ?>'</p>
        <p>Валидность email: <?= $results['email_valid'] ? 'Корректный email' : 'Некорректный email' ?></p>
        <p>Вывод кода: <?= $results['code'] ?></p>
    </div>
</body>
</html>