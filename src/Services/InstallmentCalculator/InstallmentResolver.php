<?php

namespace App\Services\InstallmentCalculator;

class InstallmentResolver
{
    public function resolve(int $installments): InstallmentStrategy
    {
        return $installments === 1 ? new SingleInstallment() : new MultipleInstallments();
    }
}