<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\Team;
use App\Entity\User;
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

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('user1@user.fr');
        $user1->setFirstName('user1');
        $user1->setLastName('userlast1');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'user1@user.fr'));
        $manager->persist($user1);

        $user1 = new User();
        $user1->setEnabled(true);
        $user1->setEmail('admin@admin.fr');
        $user1->setFirstName('admin');
        $user1->setLastName('adminlast');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'admin'));
        $user1->setRoles(['ROLE_ADMIN']);
        $manager->persist($user1);


        $team1 = new Team();
        $team1->setFlag('France');
        $team1->setName('fr');
        $manager->persist($team1);

        $team2 = new Team();
        $team2->setFlag('Allemagne');
        $team2->setName('GER');
        $manager->persist($team2);

        $team3 = new Team();
        $team3->setFlag('Argentine');
        $team3->setName('arg');
        $manager->persist($team3);

        $team3 = new Team();
        $team3->setFlag('ecosse');
        $team3->setName('ECO');
        $manager->persist($team3);

        $team4 = new Team();
        $team4->setFlag('brésil');
        $team4->setName('BRE');
        $manager->persist($team4);

        $team5 = new Team();
        $team5->setFlag('pologne');
        $team5->setName('POL');
        $manager->persist($team5);

        $team6 = new Team();
        $team6->setFlag('Corée');
        $team6->setName('COR');
        $manager->persist($team6);


        $match1 = new Game();
        $match1->setDate(new \DateTime('now'));
        $match1->setRating(1);
        $match1->setScoreTeamA(rand(1,10));
        $match1->setScoreTeamB(rand(1,10));
        $match1->setTeamA($team1);
        $match1->setTeamB($team2);
        $manager->persist($match1);


        $match2 = new Game();
        $match2->setDate(new \DateTime('now'));
        $match2->setRating(1);
        $match2->setScoreTeamA(rand(1,10));
        $match2->setScoreTeamB(rand(1,10));
        $match2->setTeamA($team2);
        $match2->setTeamB($team3);
        $manager->persist($match2);

        $match3 = new Game();
        $match3->setDate(new \DateTime('now'));
        $match3->setRating(1);
        $match3->setScoreTeamA(rand(1,10));
        $match3->setScoreTeamB(rand(1,10));
        $match3->setTeamA($team4);
        $match3->setTeamB($team5);
        $manager->persist($match3);

        $match4 = new Game();
        $match4->setDate(new \DateTime('now'));
        $match4->setRating(1);
        $match4->setScoreTeamA(rand(1,10));
        $match4->setScoreTeamB(rand(1,10));
        $match4->setTeamA($team4);
        $match4->setTeamB($team1);
        $manager->persist($match4);

        $match5 = new Game();
        $match5->setDate(new \DateTime('now'));
        $match5->setRating(1);
        $match5->setScoreTeamA(rand(1,10));
        $match5->setScoreTeamB(rand(1,10));
        $match5->setTeamA($team3);
        $match5->setTeamB($team5);
        $manager->persist($match5);


        $manager->flush();
    }
}
