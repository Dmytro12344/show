<?php


namespace AppBundle\Controller;

use AppBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;


class ProductsController extends Controller
{
    public function showAction(Request $request)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $product,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('products.html.twig', ['products' => $pagination]);
    }

    public function createAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash('success', 'Product was created');
            return $this->redirectToRoute('show_products');
        }

        return $this->render('create_product.html.twig', ['form' => $form->createView()]);
    }

    public function updateAction(request $request, Product $product)
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Product was updates');
            return $this->redirectToRoute('show_products');
        }
        return $this->render('create_product.html.twig', ['form' => $form->createView()]);
    }


    public function deleteAction(Product $product)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();
        $this->addFlash('success', 'Product was deleted');
        return $this->redirectToRoute('show_products');
    }
}