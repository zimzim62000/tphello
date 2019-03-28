<?php

namespace App\DataFixtures;


use App\Entity\Product;
use App\Entity\User;
use App\Entity\UserProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user@user.fr');
        $user1->setFirstName('user');
        $user1->setLastName('userlast');
        $user1->setRoles([" ROLE_USER"]);
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user@user.fr'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEnabled(true);
        $user2->setEmail('user1@user.fr');
        $user2->setFirstName('user1');
        $user2->setLastName('userlast1');
        $user2->setRoles([" ROLE_USER"]);
        $user2->setPassword($this->passwordEncoder->encodePassword($user2,'user1@user.fr'));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEnabled(true);
        $user3->setEmail('user2@user.fr');
        $user3->setFirstName('user2');
        $user3->setLastName('userlast2');
        $user3->setRoles([" ROLE_USER"]);
        $user3->setPassword($this->passwordEncoder->encodePassword($user1,'user2@user.fr'));
        $manager->persist($user3);

        $product = new Product();
        $product->setName("Banane");
        $product->setPrice("4");
        $product->setCreatedAt(new \DateTime());
        $product->setQuantity("400");
        $manager->persist($product);

        $product2 = new Product();
        $product2->setName("Fraise");
        $product2->setPrice("5");
        $product2->setCreatedAt(new \DateTime());
        $product2->setQuantity("300");
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName("Oranges");
        $product3->setPrice("2");
        $product3->setCreatedAt(new \DateTime());
        $product3->setQuantity("759");
        $manager->persist($product3);

        $product4 = new Product();
        $product4->setName("Navet");
        $product4->setPrice("3");
        $product4->setCreatedAt(new \DateTime());
        $product4->setQuantity("109");
        $manager->persist($product4);

        $product5 = new Product();
        $product5->setName("Raisins");
        $product5->setPrice("7");
        $product5->setCreatedAt(new \DateTime());
        $product5->setQuantity("260");
        $manager->persist($product5);

        $productUser = new UserProduct();
        $productUser->setProduct($product);
        $productUser->setUser($user1);
        $productUser->setQuantity("100");
        $productUser->setCreatedAt(new \DateTime());
        $manager->persist($productUser);

        $productUser2 = new UserProduct();
        $productUser2->setProduct($product2);
        $productUser2->setUser($user1);
        $productUser2->setQuantity("50");
        $productUser2->setCreatedAt(new \DateTime());
        $manager->persist($productUser2);

        $productUser3 = new UserProduct();
        $productUser3->setProduct($product3);
        $productUser3->setUser($user2);
        $productUser3->setQuantity("100");
        $productUser3->setCreatedAt(new \DateTime());
        $manager->persist($productUser3);

        $productUser4 = new UserProduct();
        $productUser4->setProduct($product4);
        $productUser4->setUser($user2);
        $productUser4->setQuantity("75");
        $productUser4->setCreatedAt(new \DateTime());
        $manager->persist($productUser4);


        $productUser5 = new UserProduct();
        $productUser5->setProduct($product3);
        $productUser5->setUser($user3);
        $productUser5->setQuantity("75");
        $productUser5->setCreatedAt(new \DateTime());
        $manager->persist($productUser5);

        $productUser6 = new UserProduct();
        $productUser6->setProduct($product4);
        $productUser6->setUser($user3);
        $productUser6->setQuantity("40");
        $productUser6->setCreatedAt(new \DateTime());
        $manager->persist($productUser6);


        $manager->flush();
    }
}
