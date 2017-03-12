<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Email;
use PhpUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider providerInvalidEmail
     */
    public function testSetInvalidEmail($string)
    {
        $email = new Email();
        $email->setEmail($string);
    }

    public function providerInvalidEmail()
    {
        return array(
            array('abc'),
            array(null),
            array(''),
            array('john.due@')
        );
    }

    public function testSetValidEmail()
    {
        $string = 'email@email.com';
        $email = new Email();
        $email->setEmail($string);
        $this->assertEquals($string, $email->getEmail());
    }
}