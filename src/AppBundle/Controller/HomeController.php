<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends Controller
{
    public function showAction(Request $request)
    {
	$locale = $request->getLocale();
//	dump($locale);die();
        $name = 'Dmytro';
        $title = 'Hello World';
        return $this->render('home.html.twig', ['name' => $name, 'title' => $title]);
    }


}
