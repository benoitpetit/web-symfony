<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GenderRepository")
 */
class Gender
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $men;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $women;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMen(): ?string
    {
        return $this->men;
    }

    public function setMen(string $men): self
    {
        $this->men = $men;

        return $this;
    }

    public function getWomen(): ?string
    {
        return $this->women;
    }

    public function setWomen(string $women): self
    {
        $this->women = $women;

        return $this;
    }
}
