<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

class HomeControllerTest extends WebTestCase{

    public function testIndex()
    {
        $this->client = static::createClient();

        $this->client->request('GET', '/');

        $this->assertEquals(200,  $this->client->getResponse()->getStatusCode());
    }

    public function testTitleIndex()
    {
        $this->client = static::createClient();

        $crawler = $this->client->request('GET', '/');

        $this->assertEquals('Tester son code', $crawler->filter('h1.title')->text());
    }
}