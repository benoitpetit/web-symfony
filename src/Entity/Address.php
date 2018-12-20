<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=5, 
     *     max=45, 
     *     minMessage="doit faire plus de 5 caractères",
     *     maxMessage="ne peut pas faire plus de 45 caratères"
     *     )
     */
    private $addressType;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[a-zA-Z]/", message="{{ value }} n'est pas valide")
     * @Assert\Length(
     *      min=5, 
     *      max=30, 
     *      minMessage="doit faire plus de 5 caractères",
     *      maxMessage="ne peut pas faire plus de 30 caratères"
     *      )
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[1-9]/", message="{{ value }} doit contenir uniquement des chiffres")
     * @Assert\Length(
     *      min=5, 
     *      max=5, 
     *      minMessage="doit contenir 5 chiffres",
     *      maxMessage="ne peut pas faire plus de  30 chiffres"
     *      )
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[a-zA-Z]/", message="{{ value }} n'est pas un nom de ville valide")
     * @Assert\Length(
     *      min=3, 
     *      max=30, 
     *      minMessage="La ville doit faire plus de 3 caractères",
     *      maxMessage="La ville ne peut pas faire plus de 30 caratères"
     *      )
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Choice({"France", "Belgium"})
     */
    private $country;

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
        // set default address type
        $this->addressType = ( ($this->getAddressType() == NULL) OR ($this->getAddressType() != "@DELIVERY") ) ? "@BILLING" : "@DELIVERY";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressType(): ?string
    {
        return $this->addressType;
    }

    public function setAddressType(string $addressType): self
    {
        $this->addressType = $addressType;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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
