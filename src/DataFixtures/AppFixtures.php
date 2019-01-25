<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\User;
use App\Entity\Weapon;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use DateTime;

class AppFixtures extends Fixture {
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {
        $date = new DateTime('now');

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
        $user1->setEmail('admin@admin.fr');
        $user1->setFirstName('admin');
        $user1->setLastName('admin');
        $user1->setRoles(array('ROLE_ADMIN','ROLE_SUPER_ADMIN'));
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'admin@admin.fr'));
        $manager->persist($user1);


        $team1  = new Team();
        $team1->setName("Equipe 1");
        $team1->setFlag("France");
        $manager->persist($team1);

        $team2  = new Team();
        $team2->setName("Equipe 2");
        $team2->setFlag("Allemagne");
        $manager->persist($team2);

        $team3  = new Team();
        $team3->setName("Equipe 3");
        $team3->setFlag("Italie");
        $manager->persist($team3);

        $team4  = new Team();
        $team4->setName("Equipe 4");
        $team4->setFlag("Angleterre");
        $manager->persist($team4);

        $team5  = new Team();
        $team5->setName("Equipe 5");
        $team5->setFlag("MAROC");
        $manager->persist($team5);

        $team6  = new Team();
        $team6->setName("Equipe 6");
        $team6->setFlag("USA");
        $manager->persist($team6);

        $match1 = new Game();
        $match1->setDate($date);
        $match1->setTeamA($team3);
        $match1->setTeamB($team4);
        $match1->setScoreTeamA(5);
        $match1->setScoreTeamB(2);
        $match1->setRating(1.4);
        $manager->persist($match1);

        $match2 = new Game();
        $match2->setDate($date);
        $match2->setTeamA($team2);
        $match2->setTeamB($team3);
        $match2->setScoreTeamA(4);
        $match2->setScoreTeamB(6);
        $match2->setRating(1.4);
        $manager->persist($match2);

        $match3 = new Game();
        $match3->setDate($date);
        $match3->setTeamA($team1);
        $match3->setTeamB($team4);
        $match3->setScoreTeamA(4);
        $match3->setScoreTeamB(3);
        $match3->setRating(1.4);
        $manager->persist($match3);

        $match3 = new Game();
        $match3->setDate($date);
        $match3->setTeamA($team3);
        $match3->setTeamB($team1);
        $match3->setScoreTeamA(4);
        $match3->setScoreTeamB(4);
        $match3->setRating(1.4);
        $manager->persist($match3);

        $match4 = new Game();
        $match4->setDate($date);
        $match4->setTeamA($team5);
        $match4->setTeamB($team6);
        $match4->setScoreTeamA(4);
        $match4->setScoreTeamB(6);
        $match4->setRating(1.4);
        $manager->persist($match4);

        $manager->flush();
    }
}
