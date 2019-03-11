<?php

namespace App\Services;

use App\Services\Athlete\AthleteService;
use App\Services\Coach\CoachService;
use App\Services\CrossfitClass\ClassService;
use App\Services\Token\TokenService;

class ServiceContainer
{

    private $coachService;
    private $tokenService;
    private $classService;
    private $athleteService;

    public function __construct(CoachService $coachService, TokenService $tokenService,
                                ClassService $classService, AthleteService $athleteService)
    {
        $this->coachService = $coachService;
        $this->tokenService = $tokenService;
        $this->classService = $classService;
        $this->athleteService = $athleteService;
    }

    public function getCoachService()
    {
        return $this->coachService;
    }

    public function getTokenService()
    {
        return $this->tokenService;
    }

    public function getClassService()
    {
        return $this->classService;
    }

    public function getAthleteService()
    {
        return $this->athleteService;
    }
}