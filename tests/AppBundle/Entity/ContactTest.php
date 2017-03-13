<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Contact;
use AppBundle\Entity\Email;
use AppBundle\Entity\Phone;
use Doctrine\Common\Collections\ArrayCollection;
use PhpUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    public function testSetBasicContact()
    {
        $name = 'Fulano de tal';
        $image = 'https://www.chowstatic.com/assets/recipe_photos/30175_easy_pumpkin_pie.jpg';

        $contact = new Contact();
        $contact->setName($name)->setImage($image);

        $this->assertEquals($name, $contact->getName());
        $this->assertEquals($image, $contact->getImage());
        $this->assertCount(0, $contact->getPhones());
        $this->assertCount(0, $contact->getEmails());
    }

    public function testSetPhones()
    {
        $collection = new ArrayCollection();
        for ($i = 0; $i < 3; $i++) {
            $collection->add(new Phone());
        }

        $contact = new Contact();
        $contact->setPhones($collection);
        $this->assertCount(3, $contact->getPhones());

        foreach ($contact->getPhones() as $phone) {
            $this->assertInstanceOf('AppBundle\Entity\Phone', $phone);
        }
    }

    public function testSetEmails()
    {
        $collection = new ArrayCollection();
        for ($i = 0; $i < 3; $i++) {
            $collection->add(new Email());
        }

        $contact = new Contact();
        $contact->setEmails($collection);
        $this->assertCount(3, $contact->getEmails());

        foreach ($contact->getEmails() as $email) {
            $this->assertInstanceOf('AppBundle\Entity\Email', $email);
        }
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider providerInvalidName
     * @param string $name
     */
    public function testSetInvalidName($name)
    {
        $contact = new Contact();
        $contact->setName($name);
    }

    public function providerInvalidName()
    {
        return array(
            array(''),
            array(null),
            array(' ')
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider providerInvalidImage
     * @param string $image
     */
    public function testSetInvalidImage($image)
    {
        $contact = new Contact();
        $contact->setImage($image);
    }

    public function providerInvalidImage()
    {
        return array(
            array(''),
            array(null),
            array(' ')
        );
    }
}