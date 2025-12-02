<?php
declare(strict_types=1);

function getTable($rows = 5, $cols = 5, $color = '#90ee90') {
    echo "<table>";
    for ($i = 1; $i <= $rows; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $cols; $j++) {
            if ($i == 1 || $j == 1) {
                // первая строка или первый столбец
                echo "<th style='background-color: $color; text-align: center; font-weight: bold;'>" . ($i * $j) . "</th>";
            } else {
                echo "<td>" . ($i * $j) . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}




function getMenu(array $menu): string {
    $html = "<ul>";
    foreach ($menu as $link => $title) {
        $html .= "<li><a href='$link'>$title</a></li>";
    }
    $html .= "</ul>";
    return $html;
}
