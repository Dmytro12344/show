<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Query\ResultSetMapping;


class CountController extends Controller
{
    /**
     * @Route("/count-cost", name="count_cost")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $query = "SELECT SUM(price) as count_price, COUNT(id) as count_id, (SELECT name FROM product_category WHERE id = p.category_id) as category_name FROM product AS p GROUP BY category_id";


        $data = $em->getConnection()->prepare($query);
        $data->execute();
        $result = $data->fetchAll();

        return $this->render('count-cost.html.twig', ['result' => $result]);
    }
}