<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategory;
use AppBundle\Form\ProductCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories")
 */
class ProductCategoryController extends Controller
{
    /**
     * @Route("/", name="show_category")
     */
    public function showAction()
    {
        $categories = $this->getDoctrine()
            ->getRepository(ProductCategory::class)
            ->findAll();

        if(!$categories)
        {
            throw $this->createNotFoundException(
                'No product found'
            );
        }
        return $this->render('categories_products.html.twig', ['categories' => $categories]);
    }

    /**
     * @Route("/create/{id}", name="create_category", defaults={"id": null}, requirements={"id"="\d+"})
     */
    public function createAction(Request $request, $id)
    {
        if($id !== null)
        {
            $category = $this->getDoctrine()
                ->getRepository(ProductCategory::class)
                ->find($id);
            if(!$category)
            {
                throw $this->createNotFoundException('The category does not exist');
            }
            $form = $this->createForm(ProductCategoryType::class, $category);
        }
        else {
            $category = new ProductCategory();
            $form = $this->createForm(ProductCategoryType::class, $category);
        }
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'Product was created');
            return $this->redirectToRoute('show_category');
        }

        return $this->render('create_category.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/delete/{id}", name="delete_category")
     */
    public function deleteAction($id)
    {
        try {
            $category = $this->getDoctrine()
                ->getRepository(ProductCategory::class)
                ->find($id);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
            $this->addFlash('success', 'Category was deleted');
        }
        catch (\Exception $e)
        {
            $this->addFlash('error', 'Current category does not found');
        }
        return $this->redirectToRoute('show_category');
    }
}