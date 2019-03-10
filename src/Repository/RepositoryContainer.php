<?php

namespace App\Repository;

class RepositoryContainer
{

    private $coachRepository;
    private $tokenRepository;
    private $classRepository;

    public function __construct(CoachRepository $coachRepository, ApiTokenRepository $tokenRepository,
                                CrossfitClassRepository $classRepository)
    {
        $this->coachRepository = $coachRepository;
        $this->tokenRepository = $tokenRepository;
        $this->classRepository = $classRepository;
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

}