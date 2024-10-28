<?php

namespace App\Services\InstallmentCalculator;

class SingleInstallment implements InstallmentStrategy {
    public function calculateTotal(float $price, int $installments): float {
        return $price;
    }
}