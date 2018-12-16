<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("email")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{

    const ROLE = [
        'BUYER' => 'ROLE_BUYER',
        'ADMIN' => 'ROLE_ADMIN'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(min=3, max=255)
     * @ORM\Column(type="string", length=45, unique=true)
     */
    private $username;

    /**
     * @Assert\Length(min=3, max=255)
     * @ORM\Column(type="string", length=45)
     */
    private $firstname;

    /**
     * @Assert\Length(min=3, max=255)
     * @ORM\Column(type="string", length=45)
     */
    private $lastname;

    /**
     * @Assert\Length(min=3, max=255)
     * @Assert\Email()
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @Assert\Length(min=3, max=50)
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * 
     */
    private $plainpassword;

    /**
     * @Assert\Length(min=10, max=45)
     * @ORM\Column(type="string", length=45)
     */
    private $phone;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @Assert\Choice({0, 1})
     * @ORM\Column(type="smallint")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist"})
     * @ORM\JoinColumn(name="address_billing_id_id", referencedColumnName="id")
     */
    private $addressBillingId;

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainpassword;
    }

    public function setPlainPassword(string $plainpassword): self
    {
        $this->plainpassword = $plainpassword;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        
        return $this;
    }
    
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        
        return $this;
    }
    
    public function getRoles()
    {
        if ( empty($this->roles) ) {
            return self::ROLE['BUYER'];
        }
        return $this->roles;
    }

    public function setRoles( array $roles ): self
    {
        $this->roles = $roles;
        return $this;
    }

    function addRole( $role )
    {
        $this->roles[] = $role;
    }
    
    public function getIsActive(): ?int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): self
    {
        $this->isActive = $isActive;

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

    // UserInterface / Suppression d'information sensible stockée dans l'entité
    public function eraseCredentials() {}

    // UserInterface / Méthode de chiffrement non utilisé (null)
    public function getSalt() {
        return null;
    }

    // Pour les informations sensibles
    public function serialize()
    {
        return $this->serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->email
        ]);
    }

    public function unserialize( $serialized ) {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->email
        ) = unserialize( $serialized, ['allowed_classes' => false] ); // Classes non instanciées
    }

}
