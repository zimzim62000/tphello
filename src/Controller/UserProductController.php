<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\UserProduct;
use App\Event\AppEvent;
use App\Event\UserProductEvent;
use App\Form\UserProductType;
use App\Repository\UserProductRepository;
use App\Security\AppAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user_product")
 */
class UserProductController extends AbstractController
{
    /**
     * @Route("/", name="user_product_index", methods="GET")
     */
    public function index(UserProductRepository $userProductRepository): Response
    {
        return $this->render('user_product/index.html.twig', ['user_products' => $userProductRepository->findAll()]);
    }

    /**
     * @Route("/new/{product}", name="user_product_new", methods="GET|POST",defaults={"product"=null})
     */
    public function new(Request $request,Product $product=null,UserProductEvent $event, EventDispatcherInterface $dispatcher): Response
    {
        $userProduct = new UserProduct();
        $form = $this->createForm(UserProductType::class, $userProduct,['product'=> $product]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event->setUserProduct($userProduct);
            $dispatcher->dispatch(AppEvent::UserProductSave, $event);

            return $this->redirectToRoute('user_product_index');
        }

        return $this->render('user_product/new.html.twig', [
            'user_product' => $userProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_product_show", methods="GET")
     */
    public function show(UserProduct $userProduct): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::USER_PRODUCT_SHOW, $userProduct);
        return $this->render('user_product/show.html.twig', ['user_product' => $userProduct]);
    }

    /**
     * @Route("/{id}/edit", name="user_product_edit", methods="GET|POST")
     */
    public function edit(Request $request, UserProduct $userProduct): Response
    {
        $this->denyAccessUnlessGranted(AppAccess::USER_PRODUCT_EDIT, $userProduct);
        $form = $this->createForm(UserProductType::class, $userProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_product_index', ['id' => $userProduct->getId()]);
        }

        return $this->render('user_product/edit.html.twig', [
            'user_product' => $userProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_product_delete", methods="DELETE")
     */
    public function delete(Request $request, UserProduct $userProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userProduct->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userProduct);
            $em->flush();
        }

        return $this->redirectToRoute('user_product_index');
    }
}
