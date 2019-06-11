<?php


namespace AppBundle\Controller;

use AppBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Product;
use Symfony\Component\Form\FormError;


/**
 * @Route("/products")
 */
class ProductsController extends Controller
{

    /**
     * @Route("/", name="show_products")
     */
    public function showAction()
    {
        $product = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->findAll();


        if(!$product)
        {
            throw $this->createNotFoundException(
                'No product found'
            );
        }
        return $this->render('products.html.twig', ['products' => $product]);
    }

    /**
     * @Route("/create/{id}", name="create_product", defaults={"id": null}, requirements={"id"="\d+"})
     */
    public function createAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash('success', 'Product was created');
            return $this->redirectToRoute('show_products');
        }

        return $this->render('create_product.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="edit_product")
     */
    public function updateAction(request $request, $id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($product === null)
        {
            $this->addFlash('error', 'Indefinite product.');
            return $this->redirectToRoute('show_products');
        }


        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            $this->addFlash('success', 'Product was updates');
            return $this->redirectToRoute('show_products');
        }
        return $this->render('create_product.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/delete/{id}", name="delete_product")
     */
    public function deleteAction($id)
    {
        try {
            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->find($id);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
            $this->addFlash('success', 'Product was deleted');
        }
        catch (\Exception $e)
        {
            $this->addFlash('error', 'Current product does not found');
        }
        return $this->redirectToRoute('show_products');
    }
}