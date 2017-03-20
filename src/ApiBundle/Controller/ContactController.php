<?php

namespace ApiBundle\Controller;

use ApiBundle\Serialize\ContactSerialize;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Email;
use AppBundle\Entity\Phone;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class ContactController extends FOSRestController
{
    /**
     * @Get("/{id}", requirements={"id":"\d+"})
     * @param Contact $contact
     * @return Contact
     */
    public function getContactAction(Contact $contact)
    {
        return $contact;
    }

    /**
     * @Get("/")
     */
    public function getContactsAction()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Contact')->findAll();

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

//        $contact1->setEmails($emailCollection);
        $contact1->setPhones($phoneCollection);
        $contact1->setName('Alex Moreno da Costa');


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

        $phoneCallback = function ($phone) {
            if ($phone instanceof Phone) {
                return array(
                    'id' => $phone->getId(),
                    'phone' => $phone->getNumber()
                );
            }
        };

        $normalizer->setCallbacks(array('phones' => $phoneCallback, 'emails' => $emailCallback));

        $serializer = new Serializer(array($normalizer), array($encoder));

        $data = $serializer->serialize($contact1, 'json');
        VarDumper::dump($data);die();
    }

    /**
     * @Post("/")
     * @param Request $request
     * @return View
     */
    public function postContactAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm('AppBundle\Form\ContactType',$contact);
        $form->submit($request->request->all());
//        VarDumper::dump($contact);die();

        $serialize = new ContactSerialize();
        $data = $serialize->serialize($contact);

        $view = View::create($data,201);

        // ...

        $handler = $this->get('fos_rest.view_handler');
        return $handler->handle($view);
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