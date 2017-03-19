<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Respect\Validation\Validator as v;

/**
 * Class Contact
 * @package AppBundle\Entity
 */
class Contact
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var ArrayCollection
     */
    private $emails;

    /**
     * @var ArrayCollection
     */
    private $phones;

    public function __construct()
    {
        $this->emails = new ArrayCollection();
        $this->phones = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Contact
     */
    public function setName($name)
    {
        if (!v::stringType()->notEmpty()->validate($name)) {
            throw new \InvalidArgumentException(
                sprintf('O nome informado %s não é valido', $name)
            );
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Contact
     */
    public function setImage($image)
    {
        if (!v::url()->validate($image)) {
            throw new \InvalidArgumentException(
                sprintf('A URL da imagem não é valida', $image)
            );
        }

        $this->image = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Contact
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return ArrayCollection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param ArrayCollection $emails
     * @return Contact
     */
    public function setEmails(ArrayCollection $emails)
    {
        foreach ($emails as $email) {
            $email->setContact($this);
        }

        $this->emails = $emails;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param ArrayCollection $phones
     * @return Contact
     */
    public function setPhones(ArrayCollection $phones)
    {
        foreach ($phones as $phone) {
            $phone->setContact($this);
        }

        $this->phones = $phones;
        return $this;
    }
}