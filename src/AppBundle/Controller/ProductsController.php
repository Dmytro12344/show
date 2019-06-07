<?php


namespace AppBundle\Controller;


use AppBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Product;


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
    public function createAction(Request $request, $id)
    {
        if($id !== null)
        {
            $product = $this->getDoctrine()
                            ->getRepository(Product::class)
                            ->find($id);
            if(!$product)
            {
                throw $this->createNotFoundException('The product does not exist');
            }

            $form = $this->createForm(ProductType::class, $product);
        } else {
            $product = new Product();
            $form = $this->createForm(ProductType::class, $product);
        }
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
}