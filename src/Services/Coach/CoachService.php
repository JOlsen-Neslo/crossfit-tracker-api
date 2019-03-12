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

    public function create(array $classData): ?Coach
    {
        $class = $this->transform($classData);
        return $this->coachRepository->create($class);
    }

    public function find($name)
    {
        return $this->coachRepository->findOneBy(["name" => $name]);
    }

    public function transform(array $data): Coach
    {
        $coach = new Coach();
        $coach->setName($data["name"]);
        $coach->setPassword($data["password"]);

        return $coach;
    }

}