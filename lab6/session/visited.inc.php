<?php
declare(strict_types=1);

function displayVisitedPages(): void {
    if (isset($_SESSION['visited_pages']) && !empty($_SESSION['visited_pages'])) {
        echo "<h3>Список посещённых страниц:</h3>";
        echo "<ul>";
        
        foreach ($_SESSION['visited_pages'] as $index => $page) {
            $pageName = basename($page); 
            echo "<li>" . ($index + 1) . ". $pageName</li>";
        }
        
        echo "</ul>";
    } else {
        echo "<p>Вы еще не посещали другие страницы.</p>";
    }
}

displayVisitedPages();
?>