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

class AppFixtures extends Fixture {
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {

        /** USER **/

        $user = new User();
        $user->setEnabled(true);
        $user->setEmail('user@user.fr');
        $user->setFirstName('user');
        $user->setLastName('userlast');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'user@user.fr'));
        $manager->persist($user);

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user1@user.fr');
        $user1->setFirstName('user1');
        $user1->setLastName('userlast1');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user1@user.fr'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEnabled(true);
        $user2->setEmail('user2@user.fr');
        $user2->setFirstName('user2');
        $user2->setLastName('userlast2');
        $user2->setPassword($this->passwordEncoder->encodePassword($user2,'user2@user.fr'));
        $manager->persist($user2);


        /** PRODUIT **/

        $produit = new Product();
        $produit->setCreatedAt(new \DateTime('now'));
        $produit->setName("Carotte");
        $produit->setPrice(2);
        $produit->setQuantity(100);
        $manager->persist($produit);

        $produit1 = new Product();
        $produit1->setCreatedAt(new \DateTime('now'));
        $produit1->setName("Navet");
        $produit1->setPrice(5);
        $produit1->setQuantity(40);
        $manager->persist($produit1);

        $produit2 = new Product();
        $produit2->setCreatedAt(new \DateTime('now'));
        $produit2->setName("Fraise");
        $produit2->setPrice(3);
        $produit2->setQuantity(220);
        $manager->persist($produit2);

        $produit3 = new Product();
        $produit3->setCreatedAt(new \DateTime('now'));
        $produit3->setName("Salade");
        $produit3->setPrice(1);
        $produit3->setQuantity(440);
        $manager->persist($produit3);

        $produit4 = new Product();
        $produit4->setCreatedAt(new \DateTime('now'));
        $produit4->setName("Tomate");
        $produit4->setPrice(5);
        $produit4->setQuantity(70);
        $manager->persist($produit4);


        /** USER PRODUIT **/

        // USER 1
        $userProduit = new UserProduct();
        $userProduit->setCreatedAt(new \DateTime('now'));
        $userProduit->setUser($user);
        $userProduit->setProduct($produit);
        $userProduit->setQuantity(4);
        $manager->persist($userProduit);

        $userProduit = new UserProduct();
        $userProduit->setCreatedAt(new \DateTime('now'));
        $userProduit->setUser($user);
        $userProduit->setProduct($produit1);
        $userProduit->setQuantity(7);
        $manager->persist($userProduit);

        // USER 2
        $userProduit = new UserProduct();
        $userProduit->setCreatedAt(new \DateTime('now'));
        $userProduit->setUser($user1);
        $userProduit->setProduct($produit3);
        $userProduit->setQuantity(1);
        $manager->persist($userProduit);

        $userProduit = new UserProduct();
        $userProduit->setCreatedAt(new \DateTime('now'));
        $userProduit->setUser($user1);
        $userProduit->setProduct($produit4);
        $userProduit->setQuantity(12);
        $manager->persist($userProduit);

        // USER 3
        $userProduit = new UserProduct();
        $userProduit->setCreatedAt(new \DateTime('now'));
        $userProduit->setUser($user2);
        $userProduit->setProduct($produit2);
        $userProduit->setQuantity(8);
        $manager->persist($userProduit);

        $userProduit = new UserProduct();
        $userProduit->setCreatedAt(new \DateTime('now'));
        $userProduit->setUser($user2);
        $userProduit->setProduct($produit);
        $userProduit->setQuantity(4);
        $manager->persist($userProduit);

        $manager->flush();
    }
}
