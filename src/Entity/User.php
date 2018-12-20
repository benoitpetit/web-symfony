<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


// @UniqueEntity("email") génére une erreur a l'edition

/**
 * @ORM\HasLifecycleCallbacks()
 * 
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
     * @ORM\Column(type="string", length=45, unique=true)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[a-zA-Z]/", message="{{ value }} n'est pas un nom d'utilisateur valide")
     * @Assert\Length(
     *      min=2, 
     *      max=30, 
     *      minMessage="Le nom d'utilisateur doit faire plus de 2 caractères",
     *      maxMessage="Le nom d'utilisateur ne peut pas faire plus de 30 caratères"
     *      )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[a-zA-Z]/", message="{{ value }} n'est pas un prenom valide")
     * @Assert\Length(
     *      min=2, 
     *      max=30, 
     *      minMessage="Le prenom doit faire plus de 2 caractères",
     *      maxMessage="Le prenom ne peut pas faire plus de 30 caratères"
     *      )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[a-zA-Z]/", message="{{ value }} n'est pas un nom valide")
     * @Assert\Length(
     *      min=2, 
     *      max=30, 
     *      minMessage="Le nom doit faire plus de 2 caractères",
     *      maxMessage="Le nom ne peut pas faire plus de 30 caratères"
     *      )
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "{{ value }} n'est pas une adresse mail valide",
     *     checkMX = true
     *     )
     */
    private $email;

    /**
     * 
     */
    private $password;

    /**
     * 
     */
    private $plainpassword;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\Regex(pattern="/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/", message="{{ value }} n'est pas un numéro de téléphone valide")
     * @Assert\NotBlank 
     * @Assert\Length(
     *     min=10, 
     *     max=10, 
     *     minMessage="Le numero de telephone doit faire 10 caractères",
     *     maxMessage="Le numero de telephone ne peut pas faire plus de 10 caratères"
     *     )
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
     * @Assert\Valid
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist"})
     * @ORM\JoinColumn(name="address_billing_id_id", referencedColumnName="id")
     */
    private $addressBillingId;

//////////////////////////////////////////////////////////////////////////////////////////////

     /**
     * @var string le token qui servira lors de l'oubli de mot de passe
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $resetToken;

    /**
     * @return string
     */
    public function getResetToken(): string
    {
        return $this->resetToken;
    }

    /**
     * @param string $resetToken
     */
    public function setResetToken(?string $resetToken): void
    {
        $this->resetToken = $resetToken;
    }


//////////////////////////////////////////////////////////////////////////////////////////////


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
