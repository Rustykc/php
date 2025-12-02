<?php

declare(strict_types=1);

    function map(array $array, callable $callback): array
    {
        $result = [];
        foreach ($array as $value) {
            $result[] = $callback($value);
        }
        return $result;
    }

    $vars = [1, 2, 3, 4, 5];

    $squaredvars = map($vars, fn($num) => $num ** 2);

print_r($squaredvars);