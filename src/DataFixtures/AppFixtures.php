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
        $user1->setApiToken("poullop");
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

        $product1 = new Product();
        $product1->setName('PS4 Pro');
        $product1->setCreatedAt(new \DateTime('now'));
        $product1->setPrice(299.99);
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('XBOX One X');
        $product2->setCreatedAt(new \DateTime('now'));
        $product2->setPrice(325.99);
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName('Switch');
        $product3->setCreatedAt(new \DateTime('now'));
        $product3->setPrice(199.99);
        $manager->persist($product3);

        $userProduct = new UserProduct();
        $userProduct->setUser($user1);
        $userProduct->setProduct($product1);
        $userProduct->setQuantity(10);
        $manager->persist($userProduct);

        $userProduct = new UserProduct();
        $userProduct->setUser($user1);
        $userProduct->setProduct($product3);
        $userProduct->setQuantity(2);
        $manager->persist($userProduct);

        $manager->flush();
    }
}
