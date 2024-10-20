<?php

namespace App\Traits;

use NumberFormatter;

trait WithCurrencyFormatted
{
    public function formatCurrency($value): string
    {
        $formatted = new NumberFormatter("es_ES", NumberFormatter::CURRENCY);

        return $formatted->formatCurrency($value, "EUR");
    }
}
