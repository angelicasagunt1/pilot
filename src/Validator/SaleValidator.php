<?php

namespace App\Validator;

use App\Exceptions\InvalidDataException;

class SaleValidator
{
    public function validate(array $data): void
    {
        if (empty($data['car_id'])) {
            throw new InvalidDataException("The car ID is required.");
        }

        if (empty($data['name'])) {
            throw new InvalidDataException("The customer name is required.");
        }

        if (empty($data['price'])) {
            throw new InvalidDataException("The price is required.");
        }

        if (empty($data['installments']) || $data['installments'] <= 0) {
            throw new InvalidDataException("The number of installments must be greater than zero.");
        }
    }
}
