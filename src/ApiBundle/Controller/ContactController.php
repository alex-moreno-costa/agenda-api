<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Entity\Email;
use AppBundle\Entity\Phone;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\VarDumper\VarDumper;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ContactController extends Controller
{
    /**
     * @Get("/{id}", requirements={"id":"\d+"})
     * @param Contact $contact
     */
    public function getContactAction(Contact $contact)
    {

    }

    /**
     * @Get("/")
     */
    public function getContactsAction()
    {
        $contact1 = new Contact();

        $email1 = new Email();
        $email1->setContact($contact1);
        $email1->setEmail('alex_moreno_costa@hotmail.com');

        $email2 = new Email();
        $email2->setContact($contact1);
        $email2->setEmail('alex.moreno.costa@gmail.com');

        $emailCollection = new ArrayCollection();
        $emailCollection->add($email1);
        $emailCollection->add($email2);

        $phone1 = new Phone();
        $phone1->setNumber('11 39729393');
        $phone1->setContact($contact1);

        $phone2 = new Phone();
        $phone2->setNumber('11 991639898');
        $phone2->setContact($contact1);

        $phone3 = new Phone();
        $phone3->setNumber('11 9967247173');
        $phone3->setContact($contact1);

        $phoneCollection = new ArrayCollection();
        $phoneCollection->add($phone1);
        $phoneCollection->add($phone2);
        $phoneCollection->add($phone3);

        $contact1->setEmails($emailCollection);
        $contact1->setPhones($phoneCollection);
        $contact1->setName('Alex Moreno da Costa');

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());



        $serializer = new Serializer($normalizers, $encoders);

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return json_encode(array('id' => $object -> getId()));
        });

        $jsonContent = $serializer->normalize($contact1, 'json');
        VarDumper::dump($jsonContent);die();
        $data = $this->get('serializer')->serialize($contact1,'json');
        return new JsonResponse($data);
    }

    /**
     * @Post("/")
     */
    public function postContactAction()
    {

    }

    /**
     * @Put("/{id}", requirements={"id":"\d+"})
     */
    public function putContactAction(Contact $contact)
    {

    }

    /**
     * @Delete("/{id}", requirements={"id":"\d+"})
     */
    public function deleteContactAction(Contact $contact)
    {

    }
}