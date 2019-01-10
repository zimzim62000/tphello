<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Weapon;
use App\Entity\User;
use App\Entity\WeaponUser;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {

    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {

        $weapon1 = new Weapon();
        $weapon1->setName("P226");
        $weapon1->setDamage("9");
        $manager->persist($weapon1);

        $weapon2 = new Weapon();
        $weapon2->setName("Hecate II");
        $weapon2->setDamage("75");
        $manager->persist($weapon2);

        $weapon3 = new Weapon();
        $weapon3->setName("Deagle");
        $weapon3->setDamage("20");
        $manager->persist($weapon3);

        $weapon4 = new Weapon();
        $weapon4->setName("CAR-4");
        $weapon4->setDamage("30");
        $manager->persist($weapon4);

        $weapon5 = new Weapon();
        $weapon5->setName("SCAR-H");
        $weapon5->setDamage("25");
        $manager->persist($weapon5);

        /*--------------------------------------*/

        $user1 = new User();
        $user1->setPassword($this->passwordEncoder->encodePassword($user,"1234"));
        $user1->setEmail("johndoe@mail.com");
        $user1->setEnabled(1);
        $user1->setFirstName("John");
        $user1->setHealth(100);
        $user1->setLastName("Doe");
        $user1->setPlainPassword("1234");
        $roles = array("player");
        $user1->setRoles($roles);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setPassword($this->passwordEncoder->encodePassword($user,"1234"));
        $user2->setEmail("janedoe@mail.com");
        $user2->setEnabled(1);
        $user2->setFirstName("Jane");
        $user2->setHealth(100);
        $user2->setLastName("Doe");
        $user2->setPlainPassword("1234");
        $roles = array("player");
        $user2->setRoles($roles);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setPassword($this->passwordEncoder->encodePassword($user,"1234"));
        $user3->setEmail("janetsmith@mail.com");
        $user3->setEnabled(1);
        $user3->setFirstName("Janet");
        $user3->setHealth(100);
        $user3->setLastName("Smith");
        $user3->setPlainPassword("1234");
        $roles = array("player");
        $user3->setRoles($roles);
        $manager->persist($user3);

        /*--------------------------------------*/

        $manager->flush();
    }
}
