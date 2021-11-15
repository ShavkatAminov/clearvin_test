<?php

namespace App\Controller;

use App\Entity\Make;
use App\Entity\VehicleType;
use App\Repository\MakeRepository;
use App\Repository\ModelRepository;
use App\Repository\VehicleTypeRepository;
use App\Service\ModelService;
use App\Service\SearchLogService;
use App\Transformer\Model\ModelTransformer;
use App\Validator\Model\ModelValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/api/model", name="model")
 */
class ModelController extends BaseController
{
    public ModelValidator $validator;
    public ModelRepository $repository;
    public ModelService $service;
    public ModelTransformer $transformer;

    public function __construct(
        ModelValidator  $validator,
        ModelRepository $repository,
        ModelService    $service,
        ModelTransformer $transformer
    )
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->service = $service;
        $this->transformer = $transformer;
    }

    /**
     * @Route(name="model.index", methods={"GET"})
     */
    public function index(Request $request): JsonResponse
    {

        return $this->formattedResponse(
            'models',
            $this->repository->orderBy(
                $request, $this->repository->filterPageAndLimit($request)
            ),
            $this->transformer
        );
    }
    /**
     * @Route("/{type}/{make}", name="model.type.make", methods={"GET"})
     */
    public function filter(
        string $type,
        string $make,
        VehicleTypeRepository $vehicleTypeRepository,
        MakeRepository $makeRepository,
        SearchLogService $logService
    ): JsonResponse
    {
        /** @var VehicleType $vehicleType */
        $vehicleType = $this->findOneOrNotFound($vehicleTypeRepository, $type);

        /** @var Make $make */
        $make = $this->findOneOrNotFound($makeRepository, $make);

        $query = $this->repository->getModelsOfTypeAndMake($vehicleType, $make);

        $logService->create($this->get('request_stack')->getCurrentRequest(), $query);

        return $this->formattedResponse(
            'models',
            $query,
            $this->transformer
        );
    }
}