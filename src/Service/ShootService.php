<?php

namespace App\Service;

use App\Entity\Game;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ShootService
{

    /**
     * @var TranslatorInterface
     */
    private $translator;
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(TranslatorInterface $translator, SessionInterface $session)
    {
        $this->translator = $translator;
        $this->session = $session;
    }

    public function shoot(Game $attacker, Game $target, $randKill = [0,4], $randDMG = [0,1])
    {
        if (1 === rand($randKill[0], $randKill[1])) {
            //une chance sur deux de le kill
            $this->shootKill($target,$attacker);

            $this->session->getFlashBag()->add('success', $this->translator->trans('shoot.killed'));
        }

        if (1 === rand($randDMG[0], $randDMG[1])) {
            //une chance sur deux de faire 100dmg
            $this->shootDMG($target, 100);

            $this->session->getFlashBag()->add('success', $this->translator->trans('shoot.touched', ['dmg' => 100]));
        }

        $this->session->getFlashBag()->add('success', $this->translator->trans('shoot.notouched'));
    }

    public function shootKill(Game $target, Game $attacker)
    {
        $this->shootDMG($target,100);
        $target->setEndGame(true);
        $attacker->setAssassination($attacker->getAssassination()+1);
    }

    public function shootDMG(Game $target, $dmg)
    {
        $target->setDamage( $target->getDamage() - $dmg);
    }
}