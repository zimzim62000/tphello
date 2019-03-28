<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\Product;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\UserProduct;
use App\Entity\Weapon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\VarDumper\Cloner\Data;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user@user.fr');
        $user1->setFirstName('user');
        $user1->setLastName('userlast');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'user@user.fr'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEnabled(true);
        $user2->setEmail('user1@user.fr');
        $user2->setFirstName('user1');
        $user2->setLastName('userlast1');
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'user1@user.fr'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEnabled(true);
        $user3->setEmail('user2@user.fr');
        $user3->setFirstName('user2');
        $user3->setLastName('userlast2');
        $user3->setPassword($this->passwordEncoder->encodePassword($user3, 'user2@user.fr'));
        $manager->persist($user3);

        $produit1 = new Product();
        $produit1->setName('Piles')
            ->setPrice(14.99)
            ->setQuantity(44)
            ->setCreatedAt(new \DateTime());

        $userProduct1 = new UserProduct();
        $userProduct1->setProduct($produit1)
            ->setUser($user1)
            ->setQuantity(31)
            ->setCreatedAt(new \DateTime());

        $userProduct11 = new UserProduct();
        $userProduct11->setProduct($produit1)
            ->setUser($user3)
            ->setQuantity(13)
            ->setCreatedAt(new \DateTime());

        $produit2 = new Product();
        $produit2->setName('Pieces')
            ->setPrice(4.99)
            ->setQuantity(100)
            ->setCreatedAt(new \DateTime());

        $userProduct2 = new UserProduct();
        $userProduct2->setProduct($produit2)
            ->setUser($user2)
            ->setQuantity(100)
            ->setCreatedAt(new \DateTime());

        $produit3 = new Product();
        $produit3->setName('Mini voitures')
            ->setPrice(4.99)
            ->setQuantity(14)
            ->setCreatedAt(new \DateTime());

        $userProduct3 = new UserProduct();
        $userProduct3->setProduct($produit3)
            ->setUser($user1)
            ->setQuantity(6)
            ->setCreatedAt(new \DateTime());

        $produit4 = new Product();
        $produit4->setName('Maillots')
            ->setPrice(85)
            ->setQuantity(5)
            ->setCreatedAt(new \DateTime());

        $userProduct4 = new UserProduct();
        $userProduct4->setProduct($produit4)
            ->setUser($user2)
            ->setQuantity(5)
            ->setCreatedAt(new \DateTime());

        $produit5 = new Product();
        $produit5->setName('Vestes')
            ->setPrice(110)
            ->setQuantity(14)
            ->setCreatedAt(new \DateTime());

        $userProduct5 = new UserProduct();
        $userProduct5->setProduct($produit5)
            ->setUser($user3)
            ->setQuantity(5)
            ->setCreatedAt(new \DateTime());


        $manager->flush();
    }
}
