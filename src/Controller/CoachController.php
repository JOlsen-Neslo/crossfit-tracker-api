<?php

namespace App\Controller;

use App\Schema\Credentials;
use App\Services\ServiceContainer;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CoachController extends ApiController
{

    private $coachService;
    private $tokenService;

    public function __construct(ServiceContainer $container)
    {
        $this->coachService = $container->getCoachService();
        $this->tokenService = $container->getTokenService();
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

}