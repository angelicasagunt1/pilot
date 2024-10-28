<?php
// src/Services/CarSale.php
namespace App\Services;

use App\Exceptions\InvalidDataException;
use App\Exceptions\CarNotAvailableException;
use App\Services\InstallmentCalculator\InstallmentResolver;
use App\Repository\CarRepository;

class CarSale {
    protected InstallmentResolver $installmentResolver;
    private CarRepository $carRepository;

    public function __construct(InstallmentResolver $installmentResolver, CarRepository $carRepository) {
        $this->installmentResolver = $installmentResolver;
        $this->carRepository = $carRepository;
    }


    /**
     * @throws InvalidDataException
     * @throws CarNotAvailableException
     */
    public function processSale(int $carId, float $price, int $installments, string $customerName): array
    {
        $this->validateSaleData($customerName, $installments);

        $car = $this->carRepository->find($carId);

        if (empty($car)) {
            throw new CarNotAvailableException();
        }

        $installmentStrategy = $this->installmentResolver->resolve($installments);

        $totalPrice = $installmentStrategy->calculateTotal($price, $installments);

        return [
            'buyer_data' => $customerName,
            'car_data' => [
                'name' => $car->getName(),
                'price' => $car->getPrice()
            ],
            'total_amount' => $totalPrice,
            'amount_per_installment' => $totalPrice / $installments,
        ];
    }

    /**
     * @throws InvalidDataException
     */
    private function validateSaleData(string $customerName, int $installments): void
    {
        if (empty($customerName)) {
            throw new InvalidDataException("The customer name is required.");
        }

        if ($installments <= 0) {
            throw new InvalidDataException("The number of installments must be greater than zero.");
        }
    }
}
