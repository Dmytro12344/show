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
}