<?php

namespace App\Command;

use App\Entity\Game;
use App\Entity\UserCharacters;
use App\Repository\GameRepository;
use App\Repository\UserCharactersRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GameListCommand extends Command
{
    protected static $defaultName = 'game:list';
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var GameRepository
     */
    private $gameRepository;
    /**
     * @var UserCharactersRepository
     */
    private $userCharactersRepository;

    public function __construct(EntityManagerInterface $em, UserRepository $users, GameRepository $gameRepository, UserCharactersRepository $userCharactersRepository)
    {
        parent::__construct();
        $this->em = $em;
        $this->users = $users;
        $this->gameRepository = $gameRepository;
        $this->userCharactersRepository = $userCharactersRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('List all games of users')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $mail = $io->ask('Quel est le mail ?', 'user@user.fr');

        $user = $this->users->findOneBy(['email' => $mail]);
        $userCharacters = $this->userCharactersRepository->findBy(['user' => $user]);
        $games = $this->gameRepository->findBy(['userCharacters' => $userCharacters]);

        $arr = array();
        foreach ($games as $game) {
            $obj = [$game->getId(),
                $game->getPosition(),
                $game->getAssassination(),
                $game->getReanimation(),
                $game->getDamage(),
                $game->getUserCharacters()->getCharacters()->getName()];
            $arr[] = $obj;


        }

        $io->table(
            ['ID', 'position', 'assassination', 'reanimation', 'damage', 'perso'],
            $arr
        );
    }
}
