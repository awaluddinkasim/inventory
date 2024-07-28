<?php

use App\Models\Grip;

if (!function_exists('convertToNumber')) {
    function convertToNumber(string $value): float
    {
        return (float)str_replace(',', '', $value);
    }
}

if (!function_exists('generateCode')) {
    function generateCode($color, $model, $size): string
    {
        $color = trim($color);
        if (str_contains($color, '/')) {
            $words = explode('/', $color);
            $colorCode = strtolower($words[0][0] . $words[1][0]);
        } else {
            $colorCode = substr($color, 0, 2);
        }
        $modelId = str_pad($model, 6, '0', STR_PAD_LEFT);
        $sizeCode = substr($size, 0, 1);

        return strtoupper($colorCode . $modelId . $sizeCode);
    }
}
