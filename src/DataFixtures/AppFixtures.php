<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\Weapon;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {

        // LES USERS
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

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('admin@admin.admin');
        $user1->setFirstName('admin');
        $user1->setLastName('adminlast');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'admin'));
        $user1->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user1);


        // LES EQUIPES
        $equipe1 = new Team();
        $equipe1->setName("Equipe1 : la street");
        $equipe1->setFlag("FR");
        $manager->persist($equipe1);

        $equipe2 = new Team();
        $equipe2->setName("Equipe2 : le dev");
        $equipe2->setFlag("BE");
        $manager->persist($equipe2);

        $equipe3 = new Team();
        $equipe3->setName("Equipe3 : la digue");
        $equipe3->setFlag("FR");
        $manager->persist($equipe3);

        $equipe4 = new Team();
        $equipe4->setName("Equipe4 : la poule");
        $equipe4->setFlag("FR");
        $manager->persist($equipe4);

        $equipe5 = new Team();
        $equipe5->setName("Equipe5 : l'equipe de Michel");
        $equipe5->setFlag("MA");
        $manager->persist($equipe5);

        $equipe6 = new Team();
        $equipe6->setName("Equipe6 : Boulogne sur terre");
        $equipe6->setFlag("IT");
        $manager->persist($equipe6);

        $date = new DateTime('now');

        // LES MATCHS
        $match1 = new Game();
        $match1->setDate($date);
        $match1->setRating(1.7);
        $match1->setTeamA($equipe1);
        $match1->setScoreTeamA(2);
        $match1->setTeamB($equipe2);
        $match1->setScoreTeamB(4);
        $manager->persist($match1);

        $match1 = new Game();
        $match1->setDate($date);
        $match1->setRating(2.9);
        $match1->setTeamA($equipe3);
        $match1->setScoreTeamA(1);
        $match1->setTeamB($equipe4);
        $match1->setScoreTeamB(2);
        $manager->persist($match1);

        $match1 = new Game();
        $match1->setDate($date);
        $match1->setRating(3.1);
        $match1->setTeamA($equipe5);
        $match1->setScoreTeamA(0);
        $match1->setTeamB($equipe6);
        $match1->setScoreTeamB(1);
        $manager->persist($match1);

        $match1 = new Game();
        $match1->setDate($date);
        $match1->setRating(1.9);
        $match1->setTeamA($equipe1);
        $match1->setScoreTeamA(1);
        $match1->setTeamB($equipe6);
        $match1->setScoreTeamB(0);
        $manager->persist($match1);

        $match1 = new Game();
        $match1->setDate($date);
        $match1->setRating(1.1);
        $match1->setTeamA($equipe2);
        $match1->setScoreTeamA(4);
        $match1->setTeamB($equipe5);
        $match1->setScoreTeamB(1);
        $manager->persist($match1);


        $manager->flush();
    }
}
