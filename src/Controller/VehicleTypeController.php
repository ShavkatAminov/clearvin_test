<?php

namespace App\Controller;

use App\Repository\VehicleTypeRepository;
use App\Service\VehicleTypeService;
use App\Transformer\VehicleType\VehicleTypeTransformer;
use App\Validator\VehicleType\VehicleTypeValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/api/vehicle-type", name="vehicle_type")
 */
class VehicleTypeController extends BaseController
{
    public VehicleTypeValidator $validator;
    public VehicleTypeRepository $repository;
    public VehicleTypeService $service;
    public VehicleTypeTransformer $transformer;

    public function __construct(
        VehicleTypeValidator  $validator,
        VehicleTypeRepository $repository,
        VehicleTypeService    $service,
        VehicleTypeTransformer $transformer
    )
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->service = $service;
        $this->transformer = $transformer;
    }

    /**
     * @Route(name="vehicle_type.index", methods={"GET"})
     */
    public function index(Request $request): JsonResponse
    {
        return $this->formattedResponse(
            'types',
            $this->repository->orderBy(
                $request, $this->repository->filterPageAndLimit($request)
            ),
            $this->transformer
        );
    }
}