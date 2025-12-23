<?php
declare(strict_types=1);

// Код для всех страниц - сохранение информации о посещенных страницах

/*
ЗАДАНИЕ 1
- Создайте в сессии либо 
	- массив для хранения всех посещенных страниц и сохраните в качестве его очередного элемента путь к текущей странице. 
	- строку с уникальным разделителем и последовательно её дополняйте
*/

/**
 * Сохраняет информацию о посещенной странице в сессии
 * @param string $pagePath Путь к текущей странице
 */
function saveVisitedPage(string $pagePath): void {
    // Инициализируем массив посещенных страниц, если его нет
    if (!isset($_SESSION['visited_pages'])) {
        $_SESSION['visited_pages'] = [];
    }
    
    $_SESSION['visited_pages'][] = $pagePath;
}

// Получаем текущий путь страницы
$currentPage = $_SERVER['PHP_SELF'];
saveVisitedPage($currentPage);
?>