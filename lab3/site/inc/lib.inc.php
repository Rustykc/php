<?php
declare(strict_types=1);

function getTable(int $rows = 5, int $cols = 5, string $color = '#ff0000'): string {
    $html = '<table>';
    for ($i = 1; $i <= $rows; $i++) {
        $html .= '<tr>';
        for ($j = 1; $j <= $cols; $j++) {
            $style = '';
            if ($i === 1) {
                $style = "background-color: $color;";
            }
            
            if ($j === 1) {
                $style = "background-color: $color;";
            }

            if ($i === 1 && $j === 1) {
                $style = "background-color: $color;";
            }

            $html .= "<td style='$style'>" . ($i * $j) . "</td>";
        }
        $html .= '</tr>';
    }
    $html .= '</table>';
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
