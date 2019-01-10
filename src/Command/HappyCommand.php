<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Question\Question;

class HappyCommand extends Command{

    protected static $defaultName = 'app:happy';

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setDescription('Command for take a good start :)')
            ->setHelp('Say happy new year')
            ->addArgument('year', InputArgument::REQUIRED, 'What is the new year ?')
            ->addArgument('noel', InputArgument::OPTIONAL, 'Merry Christmass', false)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $defaultName = "zimzim";
        $helper = $this->getHelper('question');
        $question = new Question('Hello, what\'s your name ?(default '.$defaultName.') ', $defaultName);
        $output->writeln('====================');
        $question->setValidator(function ($answer) {
            if(!preg_match(  '/^([a-z\s]+)$/', $answer, $find)){
                throw new \RuntimeException(
                    'name only lowercase \'a-z\''
                );
            }
            return $answer;
        });
        $question->setMaxAttempts(5);
        $name = $helper->ask($input, $output, $question);
        $output->writeln('--------------------');
        $noel =  "";
        if($input->getArgument('noel') !== false){
            $noel = ' and a Merry Christmass';
        }
        $output->writeln('Hello ' . $name .', LPDIOCS2 wish you a Happy new Year ' .  $input->getArgument('year') . $noel);
    }
}