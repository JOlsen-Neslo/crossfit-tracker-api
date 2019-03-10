<?php

namespace App\Services;

use App\Services\Coach\CoachService;
use App\Services\Token\TokenService;

class ServiceContainer
{

    private $coachService;
    private $tokenService;

    public function __construct(CoachService $coachService, TokenService $tokenService)
    {
        $this->coachService = $coachService;
        $this->tokenService = $tokenService;
    }

    public function getCoachService()
    {
        return $this->coachService;
    }

    public function getTokenService()
    {
        return $this->tokenService;
    }

}