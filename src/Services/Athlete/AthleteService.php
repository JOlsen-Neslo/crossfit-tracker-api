<?php

namespace App\Services\Athlete;

use App\Entity\CrossfitClass;
use App\Repository\RepositoryContainer;

class AthleteService
{

    private $athleteRepository;

    public function __construct(RepositoryContainer $repositoryContainer)
    {
        $this->athleteRepository = $repositoryContainer->getAthleteRepository();
    }

    public function findByClass(CrossfitClass $class): array
    {
        return $this->athleteRepository->findByClass($class);
    }

}