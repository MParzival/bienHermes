<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BienHermesTest extends WebTestCase
{
    public function testHomePageStatusCode()
    {
        $client = static ::createClient();
        // je recupère directment la réponse qui a été généré
        $client->request('GET', '/');
        static::assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testHomePageFormSubmission()
    {
        $client = static ::createClient();
        // je recupère le crawler pour pouvoir parcourir le DOM de notre page
        $crawler = $client->request('GET', '/');
        $form = $crawler->selectButton('Rechercher')->form();
        $form['postalCode'] = 69600;
        $form['maxPrice'] = 200000;
        $form['activite'] = 'Restaurant';
        $form['minSurface'] = 50;

        $crawler = $client->submit($form);

        static ::assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}