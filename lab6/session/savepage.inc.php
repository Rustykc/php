<?php
declare(strict_types=1);

function saveVisitedPage(string $pagePath): void {
    if (!isset($_SESSION['visited_pages'])) {
        $_SESSION['visited_pages'] = [];
    }
    
    $_SESSION['visited_pages'][] = $pagePath;
}

$currentPage = $_SERVER['PHP_SELF'];
saveVisitedPage($currentPage);
?>