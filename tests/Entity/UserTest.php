<?php
namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends WebTestCase
{
   public function testCheckPassword()
   {
        $client = static :: createClient();

        $crawler = $client->request(
            'GET',
            '/register'
        );

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['registration_form[email]'] = 'toto@gmail.com';
        $form['registration_form[username]'] = 'toto61';
        $form['registration_form[plainPassword][first]'] = "azerty00";
        $result = $form['registration_form[plainPassword][second]'] = "azerty00";

        $crawler = $client->submit($form);
        $this->assertSame("azerty00",$result);
   }
}