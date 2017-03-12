<?php

namespace AppBundle\Entity;

use Respect\Validation\Validator as v;

/**
 * Class Email
 * @package AppBundle\Entity
 */
class Email
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Contact
     */
    private $contact;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Email
     */
    public function setEmail($email)
    {
        if (!v::email()->validate($email)) {
            throw new \InvalidArgumentException(
                sprintf('O email informado %s não é valido', $email)
            );
        }

        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     * @return Email
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
        return $this;
    }
}