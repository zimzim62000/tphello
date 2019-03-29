<?php


namespace App\Command;
use App\Entity\Game;
use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Question\Question;

class ListerMatchCommand extends Command{
    protected static $defaultName = 'app:liste';
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct();
    }
    protected function configure()
    {
        $this
            ->setDescription('Commande pour lister les matchs d\'un utilisateur par son email :)')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $defaultName = "user2";
        $helper = $this->getHelper('question');
        $question = new Question('Lister des matchs de l\'utilisateur ?(default '.$defaultName.') ', $defaultName);
        $output->writeln('====================');


        //recupere l'email de l'user
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $defaultName]);


        //recupere le match de l'user par mail
        $match = $this->em->getRepository(Game::class)->findOneBy(['userCharacters'=>$user]);

        $question->setMaxAttempts(5);
        $name = $helper->ask($input, $output, $question);
        $output->writeln('--------------------');

        //affiche les matchs de l'user
        $output->writeln($match);
    }
}