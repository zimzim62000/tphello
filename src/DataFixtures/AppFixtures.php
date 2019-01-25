<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Team;
use App\Entity\Game;

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
        $user1->setRoles([" ROLE_USER"]);
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user@user.fr'));
        $manager->persist($user1);

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user1@user.fr');
        $user1->setFirstName('user1');
        $user1->setLastName('userlast1');
        $user1->setRoles([" ROLE_USER"]);
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user1@user.fr'));
        $manager->persist($user1);

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user2@user.fr');
        $user1->setFirstName('user2');
        $user1->setLastName('userlast2');
        $user1->setRoles([" ROLE_USER"]);
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user2@user.fr'));
        $manager->persist($user1);


        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user3@user.fr');
        $user1->setFirstName('user3');
        $user1->setLastName('userlast3');
        $user1->setRoles(["ROLE_ADMIN"]);
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user3@user.fr'));
        $manager->persist($user1);

        $equipe1= new Team();
        $equipe1->setName("Team de ouf");
        $equipe1->setFlag("FR");
        $manager->persist($equipe1);

        $equipe2= new Team();
        $equipe2->setName("Team de ouf 2");
        $equipe2->setFlag("RF");
        $manager->persist($equipe2);

        $equipe3= new Team();
        $equipe3->setName("Team de ouf 3");
        $equipe3->setFlag("RU");
        $manager->persist($equipe3);

        $equipe4= new Team();
        $equipe4->setName("Team de ouf 4");
        $equipe4->setFlag("CANA");
        $manager->persist($equipe4);

        $equipe5= new Team();
        $equipe5->setName("Team de ouf 5");
        $equipe5->setFlag("FR");
        $manager->persist($equipe5);

        $equipe6= new Team();
        $equipe6->setName("Team de ouf 6");
        $equipe6->setFlag("FR");
        $manager->persist($equipe6);


        for($i=0 ; $i < 6 ; $i++)
        {
            $game1=new Game();
            $game1 -> setTeamA($equipe1);
            $game1 -> setTeamB($equipe2);
            $game1 -> setScoreTeamA(2+ $i);
            $game1 -> setScoreTeamB(4 + $i);
            $game1 ->setRating(2);
            $game1->setDate(new \DateTime("now"));

            $manager->persist($game1);

        }


        $manager->flush();
    }
}
