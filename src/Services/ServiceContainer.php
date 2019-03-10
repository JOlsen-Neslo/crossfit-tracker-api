<?php

namespace App\Services;

use App\Services\Coach\CoachService;
use App\Services\Token\TokenService;
use App\Services\CrossfitClass\ClassService;

class ServiceContainer
{

    private $coachService;
    private $tokenService;
    private $classService;

    public function __construct(CoachService $coachService, TokenService $tokenService, ClassService $classService)
    {
        $this->coachService = $coachService;
        $this->tokenService = $tokenService;
        $this->classService = $classService;
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
}