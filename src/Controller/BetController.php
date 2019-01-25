<?php

namespace App\Controller;

use App\Entity\Bet;
use App\Entity\Game;
use App\Form\BetType;
use App\Repository\BetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\AppAccess;


/**
 * @Route("/bet")
 */
class BetController extends AbstractController
{
    /**
     * @Route("/", name="bet_index", methods={"GET"})
     */
    public function index(BetRepository $betRepository): Response
    {
        return $this->render('bet/index.html.twig', [
            'bets' => $betRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{game}", name="bet_new", methods={"GET","POST"}, defaults={"game"=null})
     */
    public function new(Request $request, Game $game): Response
    {
        $bet = new Bet();

        $form = $this->createForm(BetType::class, $bet,['game' =>$game]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bet);
            $entityManager->flush();

            return $this->redirectToRoute('bet_index');
        }

        return $this->render('bet/new.html.twig', [
            'bet' => $bet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bet_show", methods={"GET"})
     */
    public function show(Bet $bet): Response
    {

        if($this->isGranted(AppAccess::ITEM_SHOW, $bet) === true){
            return $this->render('bet/show.html.twig', [
                'bet' => $bet,
            ]);
        }else{
            $this->addFlash('error', 'Vous n\'avez pas acces a ce pari desole');
            return $this->redirectToRoute('bet_index');
        }
    }

    /**
     * @Route("/{id}/edit", name="bet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bet $bet): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::ITEM_EDIT, $bet);
        $form = $this->createForm(BetType::class, $bet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_index', [
                'id' => $bet->getId(),
            ]);
        }

        return $this->render('bet/edit.html.twig', [
            'bet' => $bet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bet $bet): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::ITEM_DELETE, $bet);
        if ($this->isCsrfTokenValid('delete'.$bet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_index');
    }
}
