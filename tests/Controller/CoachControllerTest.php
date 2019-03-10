<?php

namespace App\Tests\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoachControllerTest extends WebTestCase
{

    private $client;

    public function setUp()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:8080',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    public function testAuth()
    {
        $data = array(
            'name' => "Coach",
            'password' => "12345"
        );

        $response = $this->client->post('/coach/auth', [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testAuthWrongPassword()
    {
        $data = array(
            'name' => "Coach",
            'password' => "123"
        );

        try {
            $this->client->post('/coach/auth', [
                'body' => json_encode($data)
            ]);
        } catch (ClientException $e) {
            $this->assertEquals(401, $e->getResponse()->getStatusCode());
            $this->assertEquals("Unauthorized", $e->getResponse()->getReasonPhrase());
        }
    }

    public function testAuthWrongUsername()
    {
        $data = array(
            'name' => "Coaches",
            'password' => "12345"
        );

        try {
            $this->client->post('/coach/auth', [
                'body' => json_encode($data)
            ]);
        } catch (ClientException $e) {
            $this->assertEquals(401, $e->getResponse()->getStatusCode());
            $this->assertEquals("Unauthorized", $e->getResponse()->getReasonPhrase());
        }
    }

    public function testAuthNoBody()
    {
        try {
            $this->client->post('/coach/auth');
        } catch (ClientException $e) {
            $this->assertEquals(400, $e->getResponse()->getStatusCode());
            $this->assertEquals("Bad Request", $e->getResponse()->getReasonPhrase());
        }
    }

}