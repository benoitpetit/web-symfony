<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("slug");
 * @ORM\Entity(repositoryClass="App\Repository\LogoRepository")
 */
class Logo
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
    public $parTypeProduct;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logoName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\PrePersist
     */
    function onPrePersist() {
        // Affiche la date actuelle par défaut
        $this->createdDate = new \DateTime('now',  new \DateTimeZone( 'UTC' ));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParTypeProduct(): ?string
    {
        return $this->parTypeProduct;
    }

    public function setParTypeProduct(string $parTypeProduct): self
    {
        $this->parTypeProduct = $parTypeProduct;

        return $this;
    }

    public function getLogoName(): ?string
    {
        return $this->logoName;
    }

    public function setLogoName(string $logoName): self
    {
        $this->logoName = $logoName;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

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
