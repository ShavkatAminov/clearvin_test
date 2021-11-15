<?php

namespace App\Controller;

use App\Entity\VehicleType;
use App\Repository\MakeRepository;
use App\Repository\VehicleTypeRepository;
use App\Service\MakeService;
use App\Transformer\Make\MakeTransformer;
use App\Validator\Make\MakeValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/api/make", name="make")
 */
class MakeController extends BaseController
{
    public MakeValidator $validator;
    public MakeRepository $repository;
    public MakeService $service;
    public MakeTransformer $transformer;

    public function __construct(
        MakeValidator  $validator,
        MakeRepository $repository,
        MakeService    $service,
        MakeTransformer $transformer
    )
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->service = $service;
        $this->transformer = $transformer;
    }

    /**
     * @Route(name="make.index", methods={"GET"})
     */
    public function index(Request $request): JsonResponse
    {

        return $this->formattedResponse(
            'makes',
            $this->repository->orderBy(
                $request, $this->repository->filterPageAndLimit($request)
            ),
            $this->transformer
        );
    }
    /**
     * @Route("/{type}", name="make.type", methods={"GET"})
     */
    public function type(
        string $type,
        VehicleTypeRepository $vehicleTypeRepository
    ): JsonResponse
    {
        /** @var VehicleType $vehicleType */
        $vehicleType = $this->findOneOrNotFound($vehicleTypeRepository, $type);

        return $this->formattedResponse(
            'makes',
            $this->repository->getMakesOfType($vehicleType),
            $this->transformer
        );
    }
}