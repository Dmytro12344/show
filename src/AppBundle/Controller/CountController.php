<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;



class CountController extends Controller
{
    /**
     * @Route("/count-cost", name="count_cost")
     */
    public function indexAction()
    {
        $result = $this->getDoctrine()->getRepository(Product::class)->findAllForCount();
        return $this->render('count-cost.html.twig', ['result' => $result]);
    }
}