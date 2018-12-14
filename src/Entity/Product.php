<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $priceUnitHt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ProductType", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $productTypeId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Rate", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $rateId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gender")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genderId;

    /**
     * @ORM\PrePersist
     */
    function onPrePersist() {
        // set default date
        $this->createdDate = new \DateTime('now',  new \DateTimeZone( 'UTC' ));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceUnitHt(): ?float
    {
        return $this->priceUnitHt;
    }

    public function setPriceUnitHt(float $priceUnitHt): self
    {
        $this->priceUnitHt = $priceUnitHt;

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

    public function getProductTypeId(): ?ProductType
    {
        return $this->productTypeId;
    }

    public function setProductTypeId(ProductType $productTypeId): self
    {
        $this->productTypeId = $productTypeId;

        return $this;
    }

    public function getRateId(): ?Rate
    {
        return $this->rateId;
    }

    public function setRateId(Rate $rateId): self
    {
        $this->rateId = $rateId;

        return $this;
    }

    public function getGenderId(): ?Gender
    {
        return $this->genderId;
    }

    public function setGenderId(?Gender $genderId): self
    {
        $this->genderId = $genderId;

        return $this;
    }
}
