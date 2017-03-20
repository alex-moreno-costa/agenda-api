<?php

namespace AppBundle\Crud;

use AppBundle\Entity\Contact;
use Doctrine\ORM\EntityManager;

/**
 * Class ContactCrud
 * @package AppBundle\Crud
 */
class ContactCrud
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * ContactCrud constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function create(Contact $contact, $data)
    {

    }

    public function update(Contact $contact, $data){}
    public function delete(Contact $contact){}
}