<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Weapon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {


        $p38 = new Weapon();
        $p38->setName('P38');
        $p38->setDamage(5.2);
        $manager->persist($p38);

        $uzi = new Weapon();
        $uzi->setName('Uzi');
        $uzi->setDamage(8.2);
        $manager->persist($uzi);

        $mp5 = new Weapon();
        $mp5->setName('Mp5');
        $mp5->setDamage(10.8);
        $manager->persist($mp5);

        $aka = new Weapon();
        $aka->setName('Aka 47');
        $aka->setDamage(14.8);
        $manager->persist($aka);

        $awap = new Weapon();
        $awap->setName('Awap');
        $awap->setDamage(17.8);
        $manager->persist($awap);

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user@user.fr');
        $user1->setFirstName('user');
        $user1->setLastName('userlast');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user@user.fr'));
        $manager->persist($user1);

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user1@user.fr');
        $user1->setFirstName('user1');
        $user1->setLastName('userlast1');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user1@user.fr'));
        $manager->persist($user1);

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user2@user.fr');
        $user1->setFirstName('user2');
        $user1->setLastName('userlast2');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user2@user.fr'));
        $manager->persist($user1);

        $manager->flush();
    }
}
