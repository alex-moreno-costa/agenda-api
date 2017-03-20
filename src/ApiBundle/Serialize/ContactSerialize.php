<?php

namespace ApiBundle\Serialize;

use AppBundle\Entity\Contact;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class ContactSerialize
{
    public function serialize(Contact $contact)
    {
        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();

        $emailCallback = function ($emails) {

            $array = array();
            foreach ($emails as $email) {
                array_push($array, array(
                    'id' => $email->getId(),
                    'email' => $email->getEmail()
                ));
            }
            return $array;
        };

        $phoneCallback = function ($phones) {
            $array = array();
            foreach ($phones as $phone) {
                array_push($array, array(
                    'id' => $phone->getId(),
                    'phone' => $phone->getNumber()
                ));
            }
            return $array;
        };

        $normalizer->setCallbacks(array('phones' => $phoneCallback, 'emails' => $emailCallback));
        $serializer = new Serializer(array($normalizer), array($encoder));

        return $serializer->serialize($contact, 'json');
    }
}