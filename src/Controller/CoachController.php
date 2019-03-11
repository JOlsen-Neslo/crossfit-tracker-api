<?php

namespace App\Controller;

use App\Services\ServiceContainer;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CoachController extends ApiController
{

    private $coachService;
    private $tokenService;
    private $classService;

    public function __construct(ServiceContainer $container)
    {
        $this->coachService = $container->getCoachService();
        $this->tokenService = $container->getTokenService();
        $this->classService = $container->getClassService();
    }

    /**
     * The endpoint to authenticate a coach as a user of the application.
     *
     * @Route("/api/coach/auth", methods="POST", name="coach_auth")
     * @return JsonResponse
     */
    public function authenticate(Request $request, LoggerInterface $logger)
    {
        $logger->info("Entered auth..");

        $coach = $this->transformJsonBody($request);
        if (!$coach) {
            $logger->error("The request supplied is invalid");
            return JsonResponse::create(["error" => "The request supplied is invalid"], self::BAD_REQUEST);
        }

        $savedCoach = $this->coachService->authenticate($coach);
        if (!$savedCoach) {
            $logger->error("The coach supplied is unauthorized.");
            return JsonResponse::create(["error" => "The name and password combination is invalid."], self::UNAUTHORIZED);
        }

        $token = $this->tokenService->create($savedCoach);
        $logger->info("Token: " . $token->getToken());

        $logger->info("Authenticated..");
        return JsonResponse::create(["token" => $token->getToken()]);
    }

    /**
     * The endpoint to retrieve all classes for a coach
     *
     * @Route("/api/coach/{name}/class", methods="GET", name="coach_class_list_retrieve")
     * @return JsonResponse
     */
    public function getClasses($name, LoggerInterface $logger)
    {
        $logger->info("Entered class list retrieval..");
        if (!$name) {
            $logger->error("The coach name needs to be present.");
            return JsonResponse::create(["error" => "Please supply a coach name."], self::BAD_REQUEST);
        }

        $savedCoach = $this->coachService->find($name);
        if (!$savedCoach) {
            $logger->error("The coach name supplied does not exist.");
            return JsonResponse::create(["error" => "The coach name supplied does not exist."], self::NOT_FOUND);
        }

        $classes = $this->classService->findByCoach($savedCoach);

        $logger->info("Class list retrieved..");
        return JsonResponse::create($classes);
    }

    /**
     * The endpoint to register a class for a coach
     *
     * @Route("/api/coach/{name}/class", methods="POST", name="coach_class_create")
     * @return JsonResponse
     */
    public function createClass($name, Request $request, LoggerInterface $logger)
    {
        $logger->info("Entered class creation..");

        $class = $this->transformJsonBody($request);
        if (!$class) {
            $logger->error("The request supplied is invalid");
            return JsonResponse::create(["error" => "The request supplied is invalid"], self::BAD_REQUEST);
        }

        $savedCoach = $this->coachService->find($name);
        if (!$savedCoach) {
            $logger->error("The coach name supplied does not exist.");
            return JsonResponse::create(["error" => "The coach name supplied does not exist."], self::NOT_FOUND);
        }

        $class['coach'] = $savedCoach;
        $class = $this->classService->create($class);

        $logger->info("Class created..");
        return JsonResponse::create(["class" => $class], self::CREATED);
    }

    /**
     * The endpoint to retrieve all classes for a coach
     *
     * @Route("/api/coach/{name}/class/{id}", methods="GET", name="coach_class_retrieve")
     * @return JsonResponse
     */
    public function getClass($name, $id, LoggerInterface $logger)
    {
        $logger->info("Entered class retrieval..");
        if (!$name) {
            $logger->error("The coach name needs to be present.");
            return JsonResponse::create(["error" => "Please supply a coach name."], self::BAD_REQUEST);
        }

        if (!$id) {
            $logger->error("The id of the class need to be present.");
            return JsonResponse::create(["error" => "Please supply a class id to retrieve."], self::BAD_REQUEST);
        }

        $savedCoach = $this->coachService->find($name);
        if (!$savedCoach) {
            $logger->error("The coach name supplied does not exist.");
            return JsonResponse::create(["error" => "The coach name supplied does not exist."], self::NOT_FOUND);
        }

        $class = $this->classService->findSingleClass($id);
        if (!$class) {
            $logger->error("The class id supplied does not exist.");
            return JsonResponse::create(["error" => "The class id supplied does not exist."], self::NOT_FOUND);
        }

        $logger->info(json_encode($class));

        $logger->info("Class retrieved..");
        return JsonResponse::create($class);
    }

}