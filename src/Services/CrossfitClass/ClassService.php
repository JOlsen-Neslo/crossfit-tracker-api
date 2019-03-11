<?php

namespace App\Services\CrossfitClass;

use App\Entity\Athlete;
use App\Entity\Coach;
use App\Entity\CrossfitClass;
use App\Repository\RepositoryContainer;

class ClassService
{

    private $repository;

    public function __construct(RepositoryContainer $container)
    {
        $this->repository = $container->getClassRepository();
    }

    public function create(array $classData): ?CrossfitClass
    {
        $class = $this->transform($classData);
        return $this->repository->create($class);
    }

    public function findByCoach(Coach $coach): array
    {
        return $this->repository->findBy(["coach" => $coach]);
    }

    public function findSingleClass($id): ?CrossfitClass
    {
        return $this->repository->find($id);
    }

    public function transform(array $data): CrossfitClass
    {
        $class = new CrossfitClass();
        $class->setDateTime(new \DateTime($data["dateTime"]["date"]));
        $class->setDuration($data["duration"]);

        if (isset($data["coach"])) {
            $class->setCoach($data["coach"]);
        }

        foreach ($data["athletes"] as $athleteData) {
            $athlete = new Athlete();
            $athlete->setName($athleteData["name"]);
            $athlete->setMember($athleteData["member"]);

            $athlete->addClass($class);
            $class->addAthlete($athlete);
        }

        return $class;
    }

}