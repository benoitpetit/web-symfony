<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderLineRepository")
 */
class OrderLine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer")
     */
    private $productColorId;

    /**
     * @ORM\Column(type="integer")
     */
    private $productLogoId;

    /**
     * @ORM\Column(type="integer")
     */
    private $productSizeId;

    /**
     * @ORM\Column(type="integer")
     */
    private $productGenderId;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $priceUnitHt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $promoUnitHt;

    /**
     * @ORM\Column(type="integer")
     */
    private $rateId;

    /**
     * @ORM\Column(type="float")
     */
    private $priceTotalTtc;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getProductColorId(): ?int
    {
        return $this->productColorId;
    }

    public function setProductColorId(int $productColorId): self
    {
        $this->productColorId = $productColorId;

        return $this;
    }

    public function getProductLogoId(): ?int
    {
        return $this->productLogoId;
    }

    public function setProductLogoId(int $productLogoId): self
    {
        $this->productLogoId = $productLogoId;

        return $this;
    }

    public function getProductSizeId(): ?int
    {
        return $this->productSizeId;
    }

    public function setProductSizeId(int $productSizeId): self
    {
        $this->productSizeId = $productSizeId;

        return $this;
    }

    public function getProductGenderId(): ?int
    {
        return $this->productGenderId;
    }

    public function setProductGenderId(int $productGenderId): self
    {
        $this->productGenderId = $productGenderId;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
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

    public function getPromoUnitHt(): ?float
    {
        return $this->promoUnitHt;
    }

    public function setPromoUnitHt(?float $promoUnitHt): self
    {
        $this->promoUnitHt = $promoUnitHt;

        return $this;
    }

    public function getRateId(): ?int
    {
        return $this->rateId;
    }

    public function setRateId(int $rateId): self
    {
        $this->rateId = $rateId;

        return $this;
    }

    public function getPriceTotalTtc(): ?float
    {
        return $this->priceTotalTtc;
    }

    public function setPriceTotalTtc(float $priceTotalTtc): self
    {
        $this->priceTotalTtc = $priceTotalTtc;

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

    public function getOrderId(): ?Order
    {
        return $this->orderId;
    }

    public function setOrderId(?Order $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }
}
