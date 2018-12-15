<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\StockInputRepository")
 */
class StockInput
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
    private $inputDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Color", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ColorId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Size", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $SizeId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $productId;

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

    public function getInputDate(): ?\DateTimeInterface
    {
        return $this->inputDate;
    }

    public function setInputDate(\DateTimeInterface $inputDate): self
    {
        $this->inputDate = $inputDate;

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

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getColorId(): ?Color
    {
        return $this->ColorId;
    }

    public function setColorId(Color $ColorId): self
    {
        $this->ColorId = $ColorId;

        return $this;
    }

    public function getSizeId(): ?Size
    {
        return $this->SizeId;
    }

    public function setSizeId(Size $SizeId): self
    {
        $this->SizeId = $SizeId;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->productId;
    }

    public function setProductId(Product $productId): self
    {
        $this->productId = $productId;

        return $this;
    }
}
