<?php


namespace AppBundle\Controller;

use AppBundle\Entity\ProductCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductCategoryController extends Controller
{
    public function showAction()
    {
        $categories = $this->getDoctrine()
            ->getRepository(ProductCategory::class)
            ->findAll();
        return $this->render('categories_products.html.twig', ['categories' => $categories]);
    }
}