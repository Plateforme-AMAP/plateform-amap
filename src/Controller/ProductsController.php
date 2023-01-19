<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Products;
use App\Form\ProductsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{
    /** 
     * 
     * website
     * 
     * 
     * **/
    // Viewing all products [website]
    #[Route('/', name: 'app_products')]
    public function readAll(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Products::class)->findBy([], ['id' => 'DESC']);

        return $this->render('frontOffice/products/products.html.twig', [
            'products' => $products,
            'state' => 'frontOffice',
        ]);
    }

    // Retail product display [website]
    #[Route('/produits/{id}', name: 'details_product')]
    public function read($id, ManagerRegistry $doctrine): Response
    {
        $product = $doctrine->getRepository(Products::class)->find($id);
        $products = $doctrine->getRepository(Products::class)->findAll();

        return $this->render('frontOffice/products/details_product.html.twig', [
            'products' => $products,
            'product' => $product,
            'state' => 'frontOffice',
        ]);
    }

    /** 
     * 
     * BACKOFFICE
     * 
     * 
     * **/
    // Viewing all products [backOffice]
    #[Route('/admin/produits', name: 'app_products-admin')]
    public function readAllAdmin(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Products::class)->findBy([], ['id' => 'DESC']);

        return $this->render('/backOffice/pages/pages.html.twig', [
            'products' => $products,
            'pageInclude' => '@organism/gallery/gallery.html.twig',
            'pageIncludeTitle' => 'Produits',
            'state' => 'backOffice',
        ]);
    }

     // creation of a product [backOffice]
     #[Route('/admin/produits/ajouter', name: 'add_product-admin')]
     public function add(Request $request, ManagerRegistry $doctrine): Response
     {
         $product = new Products();

         $product->setProductCreatedAt(new DateTimeImmutable());
         $formProduct = $this->createForm(ProductsType::class, $product);
         $formProduct->handleRequest($request);

         if ($formProduct->isSubmitted() && $formProduct->isValid()) {

             $entityManager = $doctrine->getManager();
             $entityManager->persist($product);
             $entityManager->flush(); 

             $this->addFlash(
                 'success',
                 'Votre bien ' . $product->getProductName() . ' a bien été ajouté !'
             );
             return $this->redirectToRoute('app_products-admin');
         }
         // We send the page with the form and we allow the creation of the view (which we will call in the template)
         return $this->render('/backOffice/pages/pages.html.twig', [
            'formProduct' => $formProduct->createView(),
            'formTitle' => 'Ajouter un produit',
            'formSubmitLabel'=> 'Ajouter',
            'pageInclude' => 'backOffice/includes/_productForm.html.twig',
            'pageIncludeTitle' => 'Ajouter un produit',
         ]);
     }

    //modification of a product [backOffice]
     #[Route('/admin/produits/modifier/{id}', name: 'edit_product-admin')]
     public function edit($id, Request $request, ManagerRegistry $doctrine): Response
     {
         $product = $doctrine->getRepository(Products::class)->find($id);

         // we enter the date of modification automatically in the form
         $product->setProductUpdatedAt(new DateTimeImmutable());
         $formProduct = $this->createForm(ProductsType::class, $product);
         $formProduct->handleRequest($request);

         if ($formProduct->isSubmitted() && $formProduct->isValid()) {

             $entityManager = $doctrine->getManager();
             $entityManager->flush(); 

             $this->addFlash(
                 'success',
                 'Votre produit ' . $product->getProductName() . ' a bien été modifié !'
             );
             return $this->redirectToRoute('app_products-admin');
         }
         return $this->render('/backOffice/pages/pages.html.twig', [
            'formProduct' => $formProduct->createView(),
            'formTitle' => 'Modifier le produit',
            'formSubmitLabel'=> 'Modifier',
            'pageInclude' => 'backOffice/includes/_productForm.html.twig',
            'pageIncludeTitle' => 'Modifier le produit',
         ]);
     }

    //suppression d'un produit [BACKOFFICE]
    #[Route('/admin/supprimer/{id}', name: 'delete_product-admin')]
    public function delete($id, ManagerRegistry $doctrine) : RedirectResponse
    {
        $product = $doctrine->getRepository(Products::class)->find($id);

        $entityManager = $doctrine->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

        //for the product the only deletion security in V1 is in the template via a confirmation alert
        $this->addFlash(
            'success',
            'Votre produit ' . $product->getProductName() . ' a bien été supprimé !'
        );

        return $this->redirectToRoute('app_products-admin');
    }
}