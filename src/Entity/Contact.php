<?php

namespace App\Entity;

use App\Entity\Property;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2,max=50)
     */
    private $firstName;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2,max=50)
     */
    private $lastName;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Regex(
     *  pattern="/[0-9]{10}/"
     * )
     */
    private $phone;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;
    
    /**
     * @var Property|null
     */
    private $property;

    /**
     * Get the value of firstName
     *
     * @return  string|null
     */ 
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param  string|null  $firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName): Contact
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return  string|null
     */ 
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param  string|null  $lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName): Contact
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get pattern="/[0-9]{10}/"
     *
     * @return  string|null
     */ 
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set pattern="/[0-9]{10}/"
     *
     * @param  string|null  $phone  pattern="/[0-9]{10}/"
     *
     * @return  self
     */ 
    public function setPhone($phone): Contact
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string|null
     */ 
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string|null  $email
     *
     * @return  self
     */ 
    public function setEmail($email): Contact
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of message
     *
     * @return  string|null
     */ 
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param  string|null  $message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of property
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set the value of property
     */
    public function setProperty(Property $property): self
    {
        $this->property = $property;

        return $this;
    }
}