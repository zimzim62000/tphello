<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Weapon;
use App\Entity\WeaponUser;
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
        $user = new User();
        $user->setEmail("antho@antho.fr")
            ->setEnabled(true)
            ->setFirstName("Anthony")
            ->setLastName("Botwin")
            ->setHealth(User::HEALT)
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->encoder->encodePassword($user, "secret"));
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail("thomas@thomas.fr")
            ->setEnabled(true)
            ->setFirstName("Thomas")
            ->setLastName("Botwin")
            ->setHealth(User::HEALT)
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->encoder->encodePassword($user2, "secret"));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail("charlie@charlie.fr")
            ->setEnabled(true)
            ->setFirstName("Charlie")
            ->setLastName("Botwin")
            ->setHealth(User::HEALT)
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->encoder->encodePassword($user3, "secret"));
        $manager->persist($user3);

        $weapon = new Weapon();
        $weapon->setName("AK-47")
            ->setDamage("45");
        $manager->persist($weapon);

        $weapon2 = new Weapon();
        $weapon2->setName("M4A4")
            ->setDamage("37");
        $manager->persist($weapon2);

        $weapon3 = new Weapon();
        $weapon3->setName("Desert Eagle")
            ->setDamage("30");
        $manager->persist($weapon3);

        $weapon4 = new Weapon();
        $weapon4->setName("AWP")
            ->setDamage("107");
        $manager->persist($weapon4);

        $weapon5 = new Weapon();
        $weapon5->setName("Scout")
            ->setDamage("50");
        $manager->persist($weapon5);

        $weaponUser = new WeaponUser();
        $weaponUser->setUser($user)
            ->setWeapon($weapon4)
            ->setAmmunition(40)
            ->setQuality(4)
            ->setActive(true);
        $manager->persist($weaponUser);

        $weaponUser2 = new WeaponUser();
        $weaponUser2->setUser($user)
            ->setWeapon($weapon3)
            ->setAmmunition(42)
            ->setQuality(1)
            ->setActive(false);
        $manager->persist($weaponUser2);

        $weaponUser3 = new WeaponUser();
        $weaponUser3->setUser($user2)
            ->setWeapon($weapon5)
            ->setAmmunition(30)
            ->setQuality(2)
            ->setActive(true);
        $manager->persist($weaponUser3);

        $weaponUser4 = new WeaponUser();
        $weaponUser4->setUser($user2)
            ->setWeapon($weapon)
            ->setAmmunition(90)
            ->setQuality(1)
            ->setActive(true);
        $manager->persist($weaponUser4);


        $manager->flush();
    }
}
