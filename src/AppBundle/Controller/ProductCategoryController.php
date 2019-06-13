<?php


namespace AppBundle\Controller;

use AppBundle\Entity\ProductCategory;
use AppBundle\Form\ProductCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductCategoryController extends Controller
{

    public function showAction()
    {
        $categories = $this->getDoctrine()
            ->getRepository(ProductCategory::class)
            ->findAll();
        return $this->render('categories_products.html.twig', ['categories' => $categories]);
    }

    public function createAction(Request $request)
    {
        $category = new ProductCategory();
        $form = $this->createForm(ProductCategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'app.category.created.success');
            return $this->redirectToRoute('show_category');
        }
        return $this->render('create_category.html.twig', ['form' => $form->createView()]);
    }


    public function updateAction(Request $request, ProductCategory $category)
    {
        $form = $this->createForm(ProductCategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'app.category.updated.success');
            return $this->redirectToRoute('show_category');
        }

        return $this->render('create_category.html.twig', ['form' => $form->createView()]);

    }


    public function deleteAction(ProductCategory $category)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);
        $entityManager->flush();
        $this->addFlash('success', 'app.category.deleted.success');
        return $this->redirectToRoute('show_category');
    }
}