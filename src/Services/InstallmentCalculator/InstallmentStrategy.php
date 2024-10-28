<?php

namespace App\Services\InstallmentCalculator;

interface InstallmentStrategy
{
    public function calculateTotal(float $price, int $installments): float;
}