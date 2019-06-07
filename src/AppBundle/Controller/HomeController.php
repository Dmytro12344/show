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

        return $this->render('show.html.twig', ['name' => $name, 'title' => $title]);
    }


    /**
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"})
     */
    public function listAction($page = 1)
    {
        return $this->render('blog_page.html.twig', ['page' => $page]);
    }

}