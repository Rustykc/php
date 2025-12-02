<?php
declare(strict_types=1);

function getTable(int $cols, int $rows, string $color): string {
    $html = "<table>";

    for ($r = 1; $r <= $rows; $r++) {
        $html .= "<tr>";
        for ($c = 1; $c <= $cols; $c++) {
            $value = $r * $c;
            $html .= "<td style='border-color: $color;'>$value</td>";
        }
        $html .= "</tr>";
    }

    $html .= "</table>";
    return $html;
}

function getMenu(array $menu): string {
    $html = "<ul>";
    foreach ($menu as $link => $title) {
        $html .= "<li><a href='$link'>$title</a></li>";
    }
    $html .= "</ul>";
    return $html;
}
