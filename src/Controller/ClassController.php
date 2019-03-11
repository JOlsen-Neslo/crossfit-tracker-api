<?php

namespace App\Controller;

use App\Services\ServiceContainer;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ClassController extends APIController
{

    private $classService;
    private $athleteService;

    public function __construct(ServiceContainer $container)
    {
        $this->classService = $container->getClassService();
        $this->athleteService = $container->getAthleteService();
    }

    /**
     * The endpoint to retrieve the athletes linked to a class
     *
     * @Route("/api/class/{id}/athletes", methods="GET", name="class_athletes_retrieve_list")
     * @return JsonResponse
     */
    public function getAthletes($id, LoggerInterface $logger)
    {
        $logger->info("Entered athlete list retrieval..");
        if (!$id) {
            $logger->error("The class id needs to be present.");
            return JsonResponse::create(["error" => "Please supply a class id."], self::BAD_REQUEST);
        }

        $savedClass = $this->classService->findSingleClass($id);
        $logger->info("Class: " . json_encode($savedClass));
        if (!$savedClass) {
            $logger->error("The class id supplied does not exist.");
            return JsonResponse::create(["error" => "The class id supplied does not exist."], self::NOT_FOUND);
        }

        $athletes = $this->athleteService->findByClass($savedClass);

        $logger->info("Athlete list retrieved..");
        return JsonResponse::create($athletes);
    }

}