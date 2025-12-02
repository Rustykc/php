<?php
declare(strict_types=1);

function getAllConstants(): array
{
    $allConstants = get_defined_constants(true);
    
    // cортируем категории по алфавиту для удобства
    ksort($allConstants);
    
    return $allConstants;
}

function formatConstantValue($value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    
    if (is_null($value)) {
        return 'null';
    }
    
    if (is_int($value) || is_float($value)) {
        return (string)$value;
    }
    
    if (is_string($value)) {
       
        if (strlen($value) > 100) {
            return "'" . substr($value, 0, 100) . "...' (длина: " . strlen($value) . ")";
        }
        return "'" . htmlspecialchars($value) . "'";
    }
    
    if (is_array($value)) {
        return 'array(' . count($value) . ' элементов)';
    }
    
    if (is_object($value)) {
        return 'object(' . get_class($value) . ')';
    }
    
    if (is_resource($value)) {
        return 'resource(' . get_resource_type($value) . ')';
    }
    
    return gettype($value);
}

function getTotalConstantsCount(array $constants): int
{
    $total = 0;
    foreach ($constants as $categoryConstants) {
        $total += count($categoryConstants);
    }
    return $total;
}


$constants = getAllConstants();
$totalConstants = getTotalConstantsCount($constants);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Определённые константы PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .stats {
            background: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
            padding: 10px;
        }
        
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #667eea;
        }
        
        .stat-label {
            font-size: 0.9em;
            color: #6c757d;
        }
        
        .categories {
            padding: 20px;
        }
        
        .category {
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .category-header {
            background: #495057;
            color: white;
            padding: 15px 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .category-header h3 {
            margin: 0;
            font-size: 1.3em;
        }
        
        .category-count {
            background: #6c757d;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9em;
        }
        
        .constants-table {
            width: 100%;
            border-collapse: collapse;
            display: none;
        }
        
        .category.active .constants-table {
            display: table;
        }
        
        .constants-table th,
        .constants-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        
        .constants-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        
        .constants-table tr:hover {
            background: #f8f9fa;
        }
        
        .constant-name {
            font-family: 'Consolas', 'Monaco', monospace;
            font-weight: bold;
            color: #e83e8c;
        }
        
        .constant-value {
            font-family: 'Consolas', 'Monaco', monospace;
            color: #20c997;
            max-width: 400px;
            word-break: break-all;
        }
        
        .constant-type {
            color: #6c757d;
            font-size: 0.9em;
        }
        
        .no-constants {
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-style: italic;
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
        
        @media (max-width: 768px) {
            .constants-table {
                font-size: 0.9em;
            }
            
            .constants-table th,
            .constants-table td {
                padding: 8px 10px;
            }
            
            .header h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Определённые константы PHP</h1>
            <p>Полный список всех констант, доступных в текущей среде выполнения</p>
        </div>
        
        <div class="stats">
            <div class="stat-item">
                <div class="stat-number"><?= count($constants) ?></div>
                <div class="stat-label">Категорий</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?= $totalConstants ?></div>
                <div class="stat-label">Всего констант</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">PHP <?= PHP_VERSION ?></div>
                <div class="stat-label">Версия PHP</div>
            </div>
        </div>
        
        <div class="categories">
            <?php if (empty($constants)): ?>
                <div class="no-constants">
                    Константы не найдены
                </div>
            <?php else: ?>
                <?php foreach ($constants as $category => $categoryConstants): ?>
                    <div class="category">
                        <div class="category-header" onclick="toggleCategory(this)">
                            <h3><?= htmlspecialchars($category) ?></h3>
                            <span class="category-count"><?= count($categoryConstants) ?> констант</span>
                        </div>
                        
                        <table class="constants-table">
                            <thead>
                                <tr>
                                    <th width="40%">Имя константы</th>
                                    <th width="40%">Значение</th>
                                    <th width="20%">Тип</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categoryConstants as $name => $value): ?>
                                    <tr>
                                        <td>
                                            <span class="constant-name"><?= htmlspecialchars($name) ?></span>
                                        </td>
                                        <td>
                                            <span class="constant-value"><?= formatConstantValue($value) ?></span>
                                        </td>
                                        <td>
                                            <span class="constant-type"><?= gettype($value) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="footer">
            Сгенерировано <?= date('d.m.Y H:i:s') ?> | 
            Память: <?= round(memory_get_peak_usage() / 1024 / 1024, 2) ?> MB
        </div>
    </div>

    <script>
        function toggleCategory(header) {
            const category = header.parentElement;
            category.classList.toggle('active');
        }
        
        
        document.addEventListener('DOMContentLoaded', function() {
            const firstCategory = document.querySelector('.category');
            if (firstCategory) {
                firstCategory.classList.add('active');
            }
        });
        
        
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                const searchTerm = prompt('Введите имя константы для поиска:');
                if (searchTerm) {
                    searchConstants(searchTerm);
                }
            }
        });
        
        function searchConstants(searchTerm) {
            const constants = document.querySelectorAll('.constant-name');
            let found = false;
            
            constants.forEach(constant => {
                const constantText = constant.textContent.toLowerCase();
                if (constantText.includes(searchTerm.toLowerCase())) {
                    const category = constant.closest('.category');
                    category.classList.add('active');
                    constant.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    constant.style.backgroundColor = '#fff3cd';
                    found = true;
                }
            });
            
            if (!found) {
                alert('Константа "' + searchTerm + '" не найдена.');
            }
        }
    </script>
</body>
</html>