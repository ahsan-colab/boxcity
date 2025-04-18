<?php

if (! function_exists('calculatePrice')) {
    /**
     * Calculate price based on bulk.
     *
     * @param float $price
     * @param int $bulk
     * @param bool $symbol Whether to include the currency symbol (default: true)
     * @return string
     */
    function calculatePrice(float $price, int $bulk, bool $symbol = true): string
    {
        // Calculate the price based on bulk
        $calculatedPrice = match ($bulk) {
            12 => $price * 0.84,
            50 => $price * 0.70,
            100 => $price * 0.50,
            default => $price,
        };

        // If symbol is true, prepend currency symbol; otherwise, just return the number
        return $symbol ? config('app.currency_symbol') . number_format($calculatedPrice, 2) : number_format($calculatedPrice, 2);
    }
}
