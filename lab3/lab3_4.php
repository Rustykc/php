<?php
declare(strict_types=1);

function getLoadedExtensionsWithFunctions(): array
{
    $extensions = get_loaded_extensions();
    $result = [];
    
    foreach ($extensions as $extension) {
        $functions = get_extension_funcs($extension);
        $result[$extension] = $functions ?: [];
    }
    
    return $result;
}

function formatFunctionName(string $functionName): string
{
    return htmlspecialchars($functionName);
}

function generateFunctionsPage(): string
{
    $extensionsData = getLoadedExtensionsWithFunctions();
    
    $html = '<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загруженные модули PHP и их функции</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            color: white;
        }
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .header .subtitle {
            font-size: 1.2em;
            opacity: 0.9;
        }
        .stats {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            text-align: center;
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            display: block;
        }
        .stat-label {
            font-size: 0.9em;
            opacity: 0.9;
        }
        .extensions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }
        .extension-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .extension-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }
        .extension-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }
        .extension-name {
            font-size: 1.3em;
            font-weight: bold;
            color: #2c3e50;
        }
        .function-count {
            background: #667eea;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: bold;
        }
        .functions-list {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 10px;
        }
        .functions-list::-webkit-scrollbar {
            width: 6px;
        }
        .functions-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        .functions-list::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 3px;
        }
        .function-item {
            padding: 8px 12px;
            margin: 5px 0;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #667eea;
            font-family: "Courier New", monospace;
            font-size: 0.9em;
            transition: all 0.2s ease;
        }
        .function-item:hover {
            background: #e3f2fd;
            border-left-color: #764ba2;
            transform: translateX(5px);
        }
        .no-functions {
            text-align: center;
            color: #7f8c8d;
            font-style: italic;
            padding: 20px;
        }
        .search-box {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }
        .search-input {
            width: 100%;
            padding: 12px 20px;
            border: 2px solid #ddd;
            border-radius: 25px;
            font-size: 1em;
            outline: none;
            transition: border-color 0.3s ease;
        }
        .search-input:focus {
            border-color: #667eea;
        }
        @media (max-width: 768px) {
            .extensions-grid {
                grid-template-columns: 1fr;
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
            <h1>📚 Загруженные модули PHP</h1>
            <div class="subtitle">Полный список расширений и их функций</div>
        </div>
        
        <div class="search-box">
            <input type="text" id="searchInput" class="search-input" placeholder="🔍 Поиск модулей и функций...">
        </div>';
    
    // подсчет статистики
    $totalExtensions = count($extensionsData);
    $totalFunctions = 0;
    foreach ($extensionsData as $functions) {
        $totalFunctions += count($functions);
    }
    
    $html .= '<div class="stats">
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number">' . $totalExtensions . '</span>
                    <span class="stat-label">Модулей загружено</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">' . $totalFunctions . '</span>
                    <span class="stat-label">Всего функций</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">' . round($totalFunctions / max($totalExtensions, 1)) . '</span>
                    <span class="stat-label">Функций в среднем на модуль</span>
                </div>
            </div>
        </div>
        
        <div class="extensions-grid" id="extensionsGrid">';
    
    // вывод карточек модулей
    foreach ($extensionsData as $extension => $functions) {
        $functionCount = count($functions);
        
        $html .= '<div class="extension-card" data-extension="' . htmlspecialchars(strtolower($extension)) . '">
                <div class="extension-header">
                    <div class="extension-name">' . htmlspecialchars($extension) . '</div>
                    <div class="function-count">' . $functionCount . '</div>
                </div>
                <div class="functions-list">';
        
        if ($functionCount > 0) {
            sort($functions);
            foreach ($functions as $function) {
                $html .= '<div class="function-item" data-function="' . htmlspecialchars(strtolower($function)) . '">' 
                         . formatFunctionName($function) . '</div>';
            }
        } else {
            $html .= '<div class="no-functions">Нет доступных функций</div>';
        }
        
        $html .= '</div>
            </div>';
    }
    
    $html .= '</div>
    </div>
    
    <script>
        document.getElementById("searchInput").addEventListener("input", function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll(".extension-card");
            
            cards.forEach(card => {
                const extension = card.getAttribute("data-extension");
                const functionItems = card.querySelectorAll(".function-item");
                let hasMatch = extension.includes(searchTerm);
                
                functionItems.forEach(item => {
                    const functionName = item.getAttribute("data-function");
                    const matches = functionName.includes(searchTerm);
                    item.style.display = matches || hasMatch ? "block" : "none";
                    
                    if (matches) {
                        hasMatch = true;
                    }
                });
                
                card.style.display = hasMatch ? "block" : "none";
            });
        });
    </script>
</body>
</html>';
    
    return $html;
}

// Генерируем и выводим страницу
echo generateFunctionsPage();
?>