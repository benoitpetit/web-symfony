<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\ColorRepository")
 */
class Color
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
    private $colorName;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $colorHexa;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\PrePersist
     */
    function onPrePersist() {
        // set default date
        $this->createdDate = new \DateTime('now',  new \DateTimeZone( 'UTC' ));
    }

    public function getColorName(): ?string
    {
        return $this->colorName;
    }

    public function setColorName(string $colorName): self
    {
        $this->colorName = $colorName;

        return $this;
    }

    public function getColorHexa(): ?string
    {
        return $this->colorHexa;
    }

    public function setColorHexa(string $colorHexa): self
    {
        $this->colorHexa = $colorHexa;

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
