<?php

use Nette\Utils\Random;

if (!function_exists('convertToNumber')) {
    function convertToNumber(string $value): float
    {
        return (float)str_replace(',', '', $value);
    }
}

if (!function_exists('generateGripCode')) {
    function generateGripCode($color, $model, $size): string
    {
        $color = trim($color);
        if (str_contains($color, '/')) {
            $words = explode('/', $color);
            $colorCode = strtolower($words[0][0] . $words[1][0]);
        } else {
            $colorCode = substr($color, 0, 2);
        }
        $modelId = str_pad($model, 4, '0', STR_PAD_LEFT);
        $sizeCode = substr($size, 0, 2);

        return strtoupper($colorCode . $modelId . Random::generate(4, '0-9') . $sizeCode);
    }
}

if (!function_exists('generateShaftCode')) {
    function generateShaftCode($flex, $type): string
    {
        $flex = trim($flex);
        if (str_contains($flex, '/')) {
            $words = explode('/', $flex);
            $flexCode = strtolower($words[0][0] . $words[1][0]);
        } else {
            $flexCode = substr($flex, 0, 2);
        }
        $typeId = str_pad($type, 4, '0', STR_PAD_LEFT);

        return strtoupper($flexCode . $typeId . Random::generate(6, '0-9'));
    }
}
