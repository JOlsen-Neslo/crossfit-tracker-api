<?php

namespace App\Security;

use App\Repository\ApiTokenRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class ApiTokenAuthenticator extends AbstractGuardAuthenticator
{
    private $apiTokenRepo;
    private $security;

    public function __construct(ApiTokenRepository $apiTokenRepo, Security $security)
    {
        $this->apiTokenRepo = $apiTokenRepo;
        $this->security = $security;
    }

    public function supports(Request $request)
    {
        return $request->attributes->get("_route") !== "coach_auth"
            && $request->attributes->get("_route") !== "coach_create";
    }

    public function getCredentials(Request $request)
    {
        $authorizationHeader = $request->headers->get("Authorization");
        return substr($authorizationHeader, 7);
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = $this->apiTokenRepo->findOneBy([
            "token" => $credentials
        ]);

        if (!$token) {
            throw new AuthenticationException("The token supplied is invalid.");
        }

        if ($token->isExpired()) {
            throw new AuthenticationException(
                "The token supplied has expired."
            );
        }

        return $token->getCoach();
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([
            "error" => $exception->getMessageKey()
        ], 401);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse([
            "error" => "Authentication token is needed."
        ], 401);
    }

    public function supportsRememberMe()
    {
        return false;
    }

}
