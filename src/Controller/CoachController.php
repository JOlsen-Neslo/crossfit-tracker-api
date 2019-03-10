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
     * @Route("/coach/auth", methods="POST", name="coach_auth")
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
     * The endpoint to register a class for a coach
     *
     * @Route("/coach/{name}/class", methods="POST", name="coach_class_create")
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

}