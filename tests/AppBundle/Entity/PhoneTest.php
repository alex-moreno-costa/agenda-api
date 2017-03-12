<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Phone;
use PhpUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    /**
     * @dataProvider providerValidNumber
     * @param string $number
     */
    public function testSetValidPhoneNumbers($number)
    {
        $phone = new Phone();
        $phone->setNumber($number);
        $this->assertEquals($number, $phone->getNumber());
    }

    public function providerValidNumber()
    {
        return array(
            array('1112341234'),
            array('12341234'),
            array('11123456789'),
            array('11 123456789'),
            array('11 12345678'),
            array('11-12345678'),
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider providerInvalidNumber
     * @param string $number
     */
    public function testSetInvalidPhoneNumbers($number)
    {
        $phone = new Phone();
        $phone->setNumber($number);
    }

    public function providerInvalidNumber()
    {
        return array(
            array(''),
            array(null),
            array('phone number'),
            array('11 01234567891011')
        );
    }
}