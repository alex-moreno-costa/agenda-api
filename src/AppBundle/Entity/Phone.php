<?php

namespace AppBundle\Entity;

use Respect\Validation\Validator as v;

/**
 * Class Phone
 * @package AppBundle\Entity
 */
class Phone
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $number;

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
     * Set number
     *
     * @param string $number
     *
     * @return Phone
     */
    public function setNumber($number)
    {
        if (!v::phone()->validate($number)) {
            throw new \InvalidArgumentException(
                sprintf('O número de telefone informado %s não e valido',$number)
            );
        }

        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
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
     * @return Phone
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
        return $this;
    }
}