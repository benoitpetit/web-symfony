<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $orderRegister;

    /**
     * @ORM\Column(type="datetime")
     */
    private $orderDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $addressBillingId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"})
     */
    private $addressDeliveryId;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderRegister(): ?string
    {
        return $this->orderRegister;
    }

    public function setOrderRegister(string $orderRegister): self
    {
        $this->orderRegister = $orderRegister;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

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

    public function getAddressBillingId(): ?Address
    {
        return $this->addressBillingId;
    }

    public function setAddressBillingId(Address $addressBillingId): self
    {
        $this->addressBillingId = $addressBillingId;

        return $this;
    }

    public function getAddressDeliveryId(): ?Address
    {
        return $this->addressDeliveryId;
    }

    public function setAddressDeliveryId(?Address $addressDeliveryId): self
    {
        $this->addressDeliveryId = $addressDeliveryId;

        return $this;
    }
}
