<?php
namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends WebTestCase
{
    public function testUserSubmission()
    {
        $client = static ::createClient();
        // je recupère le crawler pour pouvoir parcourir le DOM de notre page
        $crawler = $client->request('GET', '/register');
        $form = $crawler->selectButton('Submit')->form();
        $form['username'] = 'Mickael';
        $form['email'] = 'Mick.aubin@gmail.com';
        $form['plainPassword'] = 'Mickalel00';

        $crawler = $client->submit($form);

        static ::assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}