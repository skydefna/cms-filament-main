<?php

namespace App\Helpers;

class ColorGenerator
{
    /**
     * Generate Tailwind-like color shades from a base hex color
     *
     * @param  string  $baseHex  Base color in hex format (e.g. #FF0000)
     * @return array Array of color shades from 50 to 900
     */
    public static function generateShades(string $baseHex): array
    {
        // Remove # if present
        $baseHex = ltrim($baseHex, '#');

        // Convert hex to RGB
        $r = hexdec(substr($baseHex, 0, 2));
        $g = hexdec(substr($baseHex, 2, 2));
        $b = hexdec(substr($baseHex, 4, 2));

        // Tailwind shade multipliers (approximate values)
        $shadeMultipliers = [
            50 => 0.95,  // Lightest
            100 => 0.9,
            200 => 0.75,
            300 => 0.6,
            400 => 0.45,
            500 => 0.3,  // Base color
            600 => 0.15,
            700 => 0,
            800 => -0.15,
            900 => -0.3, // Darkest
        ];

        $shades = [];

        foreach ($shadeMultipliers as $shade => $multiplier) {
            // Adjust RGB values
            $newR = static::adjustColorValue($r, $multiplier);
            $newG = static::adjustColorValue($g, $multiplier);
            $newB = static::adjustColorValue($b, $multiplier);

            // Convert back to hex
            $shades[$shade] = sprintf('#%02x%02x%02x', $newR, $newG, $newB);
        }

        return $shades;
    }

    /**
     * Adjust color value based on multiplier
     */
    private static function adjustColorValue(int $value, float $multiplier): int
    {
        if ($multiplier > 0) {
            // Lighten
            $adjustment = (255 - $value) * $multiplier;

            return min(255, $value + $adjustment);
        } else {
            // Darken
            $adjustment = $value * abs($multiplier);

            return max(0, $value - $adjustment);
        }
    }
}
