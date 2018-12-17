<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\ItemType;
use App\Entity\ItemType as ItemTypeEntity;
use App\Repository\ItemRepository;
use App\Security\AppAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/item")
 */
class ItemController extends AbstractController
{
    /**
     * @Route("/list/{message}", name="item_index", methods="GET", defaults={"message"=null})
     */
    public function index(ItemRepository $itemRepository, string $message = null): Response
    {
        return $this->render('item/index.html.twig', ['items' => $itemRepository->findAll(), 'message' => $message]);
    }

    /**
     * @Route("/new/{itemType}", name="item_new", methods="GET|POST", defaults={"itemType"=null})
     */
    public function new(Request $request, ItemTypeEntity $itemType = null): Response
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item, ['itemType'=> $itemType]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('item_index');
        }

        return $this->render('item/new.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="item_show", methods="GET")
     */
    public function show(Item $item): Response
    {
        if($this->isGranted(AppAccess::ITEM_SHOW, $item) === true){
            return $this->render('item/show.html.twig', ['item' => $item]);
        }else{
            return $this->redirectToRoute('item_index', ['message' => 'Vous n\'avez pas accès à cet item']);
        }
    }

    /**
     * @Route("/{id}/edit", name="item_edit", methods="GET|POST")
     */
    public function edit(Request $request, Item $item): Response
    {

        $this->denyAccessUnlessGranted(AppAccess::ITEM_EDIT, $item);

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('item_index', ['id' => $item->getId()]);
        }

        return $this->render('item/edit.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="item_delete", methods="DELETE")
     */
    public function delete(Request $request, Item $item): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::ITEM_EDIT, $item);

        if ($this->isCsrfTokenValid('delete'.$item->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($item);
            $em->flush();
        }

        return $this->redirectToRoute('item_index');
    }
}
