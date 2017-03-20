<?php

namespace Tests\ApiBundle\Controller;

use GuzzleHttp\Client;

class ContactControllerTest extends Controller
{
    private $url = 'http://api.agenda.test/v1/contact/';

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testCreateANewContact()
    {
        $data = [
            'name' => 'Alex Moreno',
            'emails' => [
                ['email' => 'alex_moreno_costa@hotmail.com'],
                ['email' => 'alex.moreno.costa@gmail.com']
            ],
            'phones' => [
                ['number' => '1112341234'],
                ['number' => '11912341234']
            ]
        ];

        $client = new Client();
        $response = $client->request(
            'POST',
                $this->url,
                ['form_params' => $data]
            );
        $this->assertEquals(201,$response->getStatusCode());
    }
}