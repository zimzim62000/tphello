<?php

namespace App\DataFixtures;

use App\Entity\Characters;
use App\Entity\Game;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\UserCharacters;
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

        $user4 = new User();
        $user4->setEnabled(true);
        $user4->setEmail('admin@admin.fr');
        $user4->setFirstName('admin');
        $user4->setLastName('admin');
        $user4->setRoles(['ROLE_ADMIN']);
        $user4->setPassword($this->passwordEncoder->encodePassword($user1,'admin@admin.fr'));
        $manager->persist($user4);


        $support = new Role();
        $support->setName('Support');
        $manager->persist($support);

        $assault = new Role();
        $assault->setName('Assault');
        $manager->persist($assault);

        $scout = new Role();
        $scout->setName('Scout');
        $manager->persist($scout);

        $medic = new Role();
        $medic->setName('Medic');
        $manager->persist($medic);

        $bang = new Characters();
        $bang->setName('Bangalore');
        $bang->setImage('none.png');
        $bang->setRole($assault);
        $manager->persist($bang);

        $blood = new Characters();
        $blood->setName('Bloodhound');
        $blood->setImage('none.png');
        $blood->setRole($scout);
        $manager->persist($blood);

        $caustic = new Characters();
        $caustic->setName('Caustic');
        $caustic->setImage('none.png');
        $caustic->setRole($support);
        $manager->persist($caustic);

        $gibra = new Characters();
        $gibra->setName('Gibraltar');
        $gibra->setImage('none.png');
        $gibra->setRole($support);
        $manager->persist($gibra);

        $lifeline = new Characters();
        $lifeline->setName('Lifeline');
        $lifeline->setImage('none.png');
        $lifeline->setRole($medic);
        $manager->persist($lifeline);

        $mirage = new Characters();
        $mirage->setName('Mirage');
        $mirage->setImage('none.png');
        $mirage->setRole($assault);
        $manager->persist($mirage);

        $path = new Characters();
        $path->setName('Pathfinder');
        $path->setImage('none.png');
        $path->setRole($medic);
        $manager->persist($path);

        $wraith = new Characters();
        $wraith->setName('Wraith');
        $wraith->setImage('none.png');
        $wraith->setRole($assault);
        $manager->persist($wraith);

        $octane = new Characters();
        $octane->setName('Octane');
        $octane->setImage('none.png');
        $octane->setRole($assault);
        $manager->persist($octane);

        $userCharactere1 = new UserCharacters();
        $userCharactere1->setUser($user1);
        $userCharactere1->setCreatedAt(new \DateTime('now'));
        $userCharactere1->setCharacters($octane);
        $userCharactere1->setFavorite(false);
        $userCharactere1->setDefaultCharacter(false);
        $manager->persist($userCharactere1);

        $userCharactere2 = new UserCharacters();
        $userCharactere2->setUser($user1);
        $userCharactere2->setCreatedAt(new \DateTime('now'));
        $userCharactere2->setCharacters($lifeline);
        $userCharactere2->setFavorite(true);
        $userCharactere2->setDefaultCharacter(false);
        $manager->persist($userCharactere2);

        $userCharactere3 = new UserCharacters();
        $userCharactere3->setUser($user2);
        $userCharactere3->setCreatedAt(new \DateTime('now'));
        $userCharactere3->setCharacters($mirage);
        $userCharactere3->setFavorite(false);
        $userCharactere3->setDefaultCharacter(false);
        $manager->persist($userCharactere3);

        $game1 = new Game();
        $game1->setCreatedAt(new \DateTime('now'));
        $game1->setPosition(2);
        $game1->setAssassination(24);
        $game1->setReanimation(0);
        $game1->setDamage(1500);
        $game1->setUserCharacters($userCharactere1);
        $game1->setEndGame(true);
        $manager->persist($game1);

        $game1 = new Game();
        $game1->setCreatedAt(new \DateTime('now'));
        $game1->setPosition(5);
        $game1->setDamage(750);
        $game1->setAssassination(14);
        $game1->setReanimation(0);
        $game1->setUserCharacters($userCharactere1);
        $game1->setEndGame(false);
        $manager->persist($game1);

        $manager->flush();

    }
}
