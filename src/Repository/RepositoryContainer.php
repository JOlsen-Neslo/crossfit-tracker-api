<?php

namespace App\Repository;

class RepositoryContainer
{

    private $coachRepository;
    private $tokenRepository;
    private $classRepository;
    private $athleteRepository;

    public function __construct(CoachRepository $coachRepository, ApiTokenRepository $tokenRepository,
                                CrossfitClassRepository $classRepository, AthleteRepository $athleteRepository)
    {
        $this->coachRepository = $coachRepository;
        $this->tokenRepository = $tokenRepository;
        $this->classRepository = $classRepository;
        $this->athleteRepository = $athleteRepository;
    }

    public function getCoachRepository()
    {
        return $this->coachRepository;
    }

    public function getTokenRepository()
    {
        return $this->tokenRepository;
    }

    public function getClassRepository()
    {
        return $this->classRepository;
    }

    public function getAthleteRepository()
    {
        return $this->athleteRepository;
    }

}