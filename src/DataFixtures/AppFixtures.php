<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Weapon;

class AppFixtures extends Fixture {

    public function load(ObjectManager $manager) {

        $weapon = new Weapon();
        $weapon->setName("P226");
        $weapon->setDamage("9");
        $manager->persist($weapon);

        $weapon = new Weapon();
        $weapon->setName("Hecate II");
        $weapon->setDamage("75");
        $manager->persist($weapon);

        $weapon = new Weapon();
        $weapon->setName("Deagle");
        $weapon->setDamage("20");
        $manager->persist($weapon);

        $weapon = new Weapon();
        $weapon->setName("CAR-4");
        $weapon->setDamage("30");
        $manager->persist($weapon);

        $weapon = new Weapon();
        $weapon->setName("SCAR-H");
        $weapon->setDamage("25");
        $manager->persist($weapon);

        $manager->flush();
    }
}
