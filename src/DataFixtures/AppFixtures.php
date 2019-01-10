<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Weapon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
	private $encoder;

	function __construct(UserPasswordEncoderInterface $encoder)
	{
		$this->encoder = $encoder;
	}

	public function load(ObjectManager $manager)
    {
		for ($i = 0; $i < 5; $i++) {
			$weapon = new Weapon();
			$weapon->setName('Arme'.$i);
			$weapon->setDamage(mt_rand(10, 50));
			$manager->persist($weapon);
		}

		for ($j = 0; $j < 3; $j++) {
			$user = new User();
			$user->setFirstName("Prenom".$j);
			$user->setLastName("Nom".$j);
			$user->setEmail("email".$j."@email.com");
			$user->setEnabled(true);
			$user->setHealth(100);
			$user->setPassword($this->encoder->encodePassword($user, "azerty"));
			$manager->persist($user);
		}

		$manager->flush();
    }
}
