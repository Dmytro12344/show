<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CountController extends Controller
{

    public function indexAction()
    {
        $result = $this->getDoctrine()->getRepository(Product::class)->findAllForCount();
        return $this->render('count-cost.html.twig', ['result' => $result]);
    }
}