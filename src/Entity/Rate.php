<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RateRepository")
 */
class Rate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $RateDateStart;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rateDateEnd;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRateDateStart(): ?\DateTimeInterface
    {
        return $this->RateDateStart;
    }

    public function setRateDateStart(\DateTimeInterface $RateDateStart): self
    {
        $this->RateDateStart = $RateDateStart;

        return $this;
    }

    public function getRateDateEnd(): ?\DateTimeInterface
    {
        return $this->rateDateEnd;
    }

    public function setRateDateEnd(?\DateTimeInterface $rateDateEnd): self
    {
        $this->rateDateEnd = $rateDateEnd;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }
}
