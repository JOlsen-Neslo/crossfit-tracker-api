<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApiTokenRepository")
 */
class ApiToken extends ApiEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expiresAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Coach", inversedBy="apiTokens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coach;

    public function __construct(Coach $coach)
    {
        $this->token = bin2hex(random_bytes(60));
        $this->coach = $coach;
        $this->expiresAt = new \DateTime('+1 hour');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function getCoach(): ?Coach
    {
        return $this->coach;
    }

    public function renewExpiresAt()
    {
        $this->expiresAt = new \DateTime('+1 hour');
    }

    public function isExpired(): bool
    {
        return $this->getExpiresAt() <= new \DateTime();
    }

}
