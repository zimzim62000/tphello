<?php

namespace App\DataFixtures;

use App\Entity\Weapon;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 5; $i++) {
            $weapon = new Weapon();
            $weapon->setName('Arme '.$i);
            $weapon->setDamage(mt_rand(10, 100));
            $manager->persist($weapon);
        }

        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setFirstName('Jiji '.$i);
            $user->setLastName('Jean'.$i);
            $password = $this->encoder->encodePassword($user, 'rootabc');
            $user->setPassword($password);
            $user->setEmail("gege".$i."@hotmail.fr");
            $user->setEnabled(true);
            $manager->persist($user);
        }





        $manager->flush();

    }
}
