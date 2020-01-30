<?php


namespace App\Tests\Entity;


use App\Entity\User;
use Generator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserUnitTest
 * @package App\Tests\Entity
 *
 * @author Mick
 */
final class UserUnitTest extends TestCase
{
    /**
     * Fonction qui teste si mon utilisateur implements bien la classe UserInterface
     * @param string $email
     * @param string $username
     * @param string $password
     *
     * @dataProvider provideCredential
     */
    public function testItImplements(string $email, string $username, string $password)
    {
        $user = new User($email, $username, $password);
        static ::assertInstanceOf(UserInterface::class, $user);
        static ::assertSame($user->getEmail(), $email);
        static ::assertSame($user->getUsername(), $username);
        static ::assertSame($user->getPassword(), $password);
    }

    /**
     * @return Generator
     */
    public function provideCredential()
    {
        yield array("toto", "toto@gmail.com", "toto");
        yield array("tata", "tata@gmail.com", "tata");
        yield array("tonton", "tonton@gmail.com", "tonton");
        yield array("titi", "titi@gmail.com", "titi");
    }
}