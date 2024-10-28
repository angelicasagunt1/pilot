<?php

namespace App\Controller;

use App\Exceptions\CarNotAvailableException;
use App\Exceptions\InvalidDataException;
use App\Services\CarSale;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarSaleController extends AbstractController
{
    private CarSale $carSaleService;

    public function __construct(CarSale $carSaleService)
    {
        $this->carSaleService = $carSaleService;
    }

    public function sellCar(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $invoice = $this->carSaleService->processSale($data['car_id'], $data['price'], $data['installments'], $data['name']);
            return new JsonResponse($invoice, Response::HTTP_OK);
        } catch (CarNotAvailableException|InvalidDataException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Ocurrió un error inesperado'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
