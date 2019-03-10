<?php

namespace App\Repository;

class RepositoryContainer
{

    private $coachRepository;
    private $tokenRepository;

    public function __construct(CoachRepository $coachRepository, ApiTokenRepository $tokenRepository)
    {
        $this->coachRepository = $coachRepository;
        $this->tokenRepository = $tokenRepository;
    }

    public function getCoachRepository()
    {
        return $this->coachRepository;
    }

    public function getTokenRepository()
    {
        return $this->tokenRepository;
    }

}