<?php


namespace AppBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }
}