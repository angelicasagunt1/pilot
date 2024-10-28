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
                'price' => $price
            ],
            'total_amount' => $totalPrice,
            'amount_per_installment' => $totalPrice / $installments,
        ];
    }
}
