<?php


namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Model du formulaire de contact
 * 
 */
class Contact
{
    
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min=3, 
     *      max=30, 
     *      minMessage="Le nom doit faire plus de 3 caractères",
     *      maxMessage="Le nom ne peu pas faire plus de 30 caratères"
     *      )
     */
    private $lastName;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min=3, 
     *      max=30, 
     *      minMessage="Le prenom doit faire plus de 3 caractères",
     *      maxMessage="Le prenom ne peu pas faire plus de 30 caratères"
     *      )
     */
    private $firstName;

    /**
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "{{ value }} n'est pas une adresse mail valide"
     *     )
     * @Assert\Email(strict=true)
     */
    private $email;

    /**
     * (nullable=true)
     * @Assert\Regex(pattern="/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/", message="{{ value }} n'est pas un numero de telephone valide")
     */
    private $phone;

    /**
     * 
     * @Assert\NotBlank
     * @Assert\Choice({"Une idée de motif à soumettre", "Un simple message"})
     */
    private $topic;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min=30, 
     *      max=255, 
     *      minMessage="Le message doit faire plus de 30 caractères",
     *      maxMessage="Le message ne peu pas faire plus de 30 caratères"
     *      )
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
