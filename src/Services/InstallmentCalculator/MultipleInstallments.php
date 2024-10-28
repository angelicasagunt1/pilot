<?php

namespace App\Services\InstallmentCalculator;

class MultipleInstallments implements InstallmentStrategy {
    public function calculateTotal(float $price, int $installments): float {
        return $price * (1 + 0.02 * ($installments - 1));
    }
}