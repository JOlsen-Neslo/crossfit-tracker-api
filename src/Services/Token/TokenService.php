<?php

namespace App\Services\Token;

use App\Entity\ApiToken;
use App\Entity\Coach;
use App\Repository\RepositoryContainer;

class TokenService
{

    private $repository;

    public function __construct(RepositoryContainer $container)
    {
        $this->repository = $container->getTokenRepository();
    }

    public function create(Coach $coach): ApiToken
    {
        $token = $this->repository->findOneBy(["coach" => $coach]);
        if ($token && !$token->isExpired()) {
            $token->renewExpiresAt();
            return $this->repository->update($token);
        }

        $token = new ApiToken($coach);
        return $this->repository->create($token);
    }

}