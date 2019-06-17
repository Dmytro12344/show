<?php


namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CountController extends Controller
{
    public function indexAction()
    {
        $result = $this->getDoctrine()->getRepository(Product::class)->findAllForCount();
        return $this->render('admin/count-cost.html.twig', ['result' => $result]);
    }
}