<?php

namespace App\Services\Coach;

use App\Entity\Coach;
use App\Repository\RepositoryContainer;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CoachService
{

    private $coachRepository;
    private $encoder;

    public function __construct(RepositoryContainer $repositoryContainer, UserPasswordEncoderInterface $encoder)
    {
        $this->coachRepository = $repositoryContainer->getCoachRepository();
        $this->encoder = $encoder;
    }

    public function authenticate(array $coach): ?Coach
    {
        $savedCoach = $this->coachRepository->findOneBy(["name" => $coach["name"]]);
        if (!$savedCoach) {
            return null;
        }

        if (!$this->encoder->isPasswordValid($savedCoach, $coach["password"])) {
            return null;
        }

        return $savedCoach;
    }

}