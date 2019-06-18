<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

        return $this->render('admin/products.html.twig', ['products' => $pagination]);
    }

    public function createAction(Request $request)
    {
        $product = new Product();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $product->setUser($this->getUser());
            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash('success', 'app.product.created.success');
            return $this->redirectToRoute('show_admin_products');
        }

        return $this->render('admin/create_product.html.twig', ['form' => $form->createView()]);
    }

    public function editAction(request $request, Product $product)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('edit', $product)) {
            throw $this->createAccessDeniedException('Unable to access this page!');
        }
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'app.product.updated.success');
            return $this->redirectToRoute('show_admin_products');
        }
        return $this->render('admin/create_product.html.twig', ['form' => $form->createView()]);
    }


    public function deleteAction(Product $product)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('edit', $product)) {
            throw $this->createAccessDeniedException('Unable to access this page!');
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();
        $this->addFlash('success', 'app.product.deleted.success');
        return $this->redirectToRoute('show_admin_products');
    }
}