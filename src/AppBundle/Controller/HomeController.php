<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function show()
    {

        $name = 'Dmytro';
        $title = 'Hello World';

        return $this->render('home.html.twig', ['name' => $name, 'title' => $title]);
    }


}