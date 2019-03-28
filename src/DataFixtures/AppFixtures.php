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

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user@user.fr');
        $user1->setFirstName('user');
        $user1->setLastName('userlast');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user@user.fr'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEnabled(true);
        $user2->setEmail('user1@user.fr');
        $user2->setFirstName('user1');
        $user2->setLastName('userlast1');
        $user2->setPassword($this->passwordEncoder->encodePassword($user1,'user1@user.fr'));
        $manager->persist($user2);


        $user3 = new User();
        $user3->setEnabled(true);
        $user3->setEmail('user2@user.fr');
        $user3->setFirstName('user2');
        $user3->setLastName('userlast2');
        $user3->setPassword($this->passwordEncoder->encodePassword($user1,'user2@user.fr'));
        $manager->persist($user3);


        $produit1 = new Product();
        $produit1->setName('FRAISE');
        $produit1->setPrice(2);
        $produit1->setQuantity(100);
        $produit1->setCreatedAt(new \DateTime('now'));
        $manager->persist($produit1);


        $produit2 = new Product();
        $produit2->setName('TOMATE');
        $produit2->setPrice(1);
        $produit2->setQuantity(100);
        $produit2->setCreatedAt(new \DateTime('now'));
        $manager->persist($produit2);

        $produit3 = new Product();
        $produit3->setName('POIVRON');
        $produit3->setPrice(3);
        $produit3->setQuantity(100);
        $produit3->setCreatedAt(new \DateTime('now'));
        $manager->persist($produit3);

        $produit4 = new Product();
        $produit4->setName('SALADE');
        $produit4->setPrice(1);
        $produit4->setQuantity(100);
        $produit4->setCreatedAt(new \DateTime('now'));
        $manager->persist($produit4);

        $produit5 = new Product();
        $produit5->setName('ANANAS');
        $produit5->setPrice(5);
        $produit5->setQuantity(100);
        $produit5->setCreatedAt(new \DateTime('now'));
        $manager->persist($produit5);


        $user1product = new UserProduct();
        $user1product->setProduct($produit1);
        $user1product->setQuantity('50');
        $user1product->setCreatedAt(new \DateTime('now'));
        $manager->persist($user1product);
        $user1product->setUser($user1);


        $user1product = new UserProduct();
        $user1product->setProduct($produit2);
        $user1product->setQuantity('50');
        $user1product->setCreatedAt(new \DateTime('now'));
        $manager->persist($user1product);
        $user1product->setUser($user1);



        $user2product = new UserProduct();
        $user2product->setProduct($produit3);
        $user2product->setQuantity('50');
        $user2product->setCreatedAt(new \DateTime('now'));
        $manager->persist($user2product);
        $user2product->setUser($user2);



        $user2product = new UserProduct();
        $user2product->setProduct($produit3);
        $user2product->setQuantity('50');
        $user2product->setCreatedAt(new \DateTime('now'));
        $manager->persist($user2product);
        $user2product->setUser($user2);


        $user3product = new UserProduct();
        $user3product->setProduct($produit1);
        $user3product->setQuantity('50');
        $user3product->setCreatedAt(new \DateTime('now'));
        $manager->persist( $user3product);
        $user3product->setUser($user3);



        $user3product = new UserProduct();
        $user3product->setProduct($produit5);
        $user3product->setQuantity('50');
        $user3product->setCreatedAt(new \DateTime('now'));
        $manager->persist( $user3product);
        $user3product->setUser($user3);


        $manager->flush();
    }
}
