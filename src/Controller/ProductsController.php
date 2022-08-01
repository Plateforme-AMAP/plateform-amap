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
     * FRONTOFFICE
     * 
     * 
     * **/
    // Affichage de l'ensemble des produits [FRONTOFFICE]
    #[Route('/produits', name: 'app_products')]
    public function readAll(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Products::class)->findBy([], ['id' => 'DESC']);

        return $this->render('frontOffice/products/products.html.twig', [
            'products' => $products,
        ]);
    }

    // Affichage d'un produit au détail [FRONTOFFICE]
    #[Route('/produits/{id}', name: 'details_product')]
    public function read($id, ManagerRegistry $doctrine): Response
    {
        $product = $doctrine->getRepository(Products::class)->find($id);
        $products = $doctrine->getRepository(Products::class)->findAll();

        return $this->render('frontOffice/products/details_product.html.twig', [
            'products' => $products,
            'product' => $product,
        ]);
    }

    /** 
     * 
     * BACKOFFICE
     * 
     * 
     * **/

    // Affichage de l'ensemble des produits [BACKOFFICE]
    #[Route('/admin/produits', name: 'app_products-admin')]
    public function readAllAdmin(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Products::class)->findBy([], ['id' => 'DESC']);

        return $this->render('backOffice/products/products.html.twig', [
            'products' => $products,
        ]);
    }

     //creation d'un produit [BACKOFFICE]
     #[Route('/admin/produits/ajouter', name: 'add_product')]
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
                 'success_add',
                 'Votre bien' . $product->getProductName() . 'a bien été ajouté !'
             );
             return $this->redirectToRoute('app_products-admin');
         }
         // On envois la page avec le formulaire et on permet la création de la vue (qu'on appellera dans le template)
         return $this->render('backOffice/products/form_product.html.twig', [
             'formProduct' => $formProduct->createView(),
             'formTitle' => 'Ajouter un bien',
             'formSubmitLabel'=> 'Ajouter',
         ]);
     }

    //modification d'un produit [BACKOFFICE]
     #[Route('/admin/produits/modifier/{id}', name: 'edit_product')]
     public function edit($id, Request $request, ManagerRegistry $doctrine): Response
     {
         $product = $doctrine->getRepository(Products::class)->find($id);
         $product->setProductUpdatedAt(new DateTimeImmutable());
         $formProduct = $this->createForm(ProductsType::class, $product);
         $formProduct->handleRequest($request);
         if ($formProduct->isSubmitted() && $formProduct->isValid()) {
             $entityManager = $doctrine->getManager();
             $entityManager->flush(); 
             $this->addFlash(
                 'success_add',
                 'Votre produit' . $product->getProductName() . 'a bien été modifié !'
             );
             return $this->redirectToRoute('app_products-admin');
         }
         return $this->render('backOffice/products/form_product.html.twig', [
             'formProduct' => $formProduct->createView(),
             'formTitle' => 'Modifier le produit',
             'formSubmitLabel'=> 'Modifier',
         ]);
     }

    //suppression d'un produit [BACKOFFICE]
    #[Route('/admin/suprimer/{id}', name: 'delete_product')]
    public function delete($id, ManagerRegistry $doctrine) : RedirectResponse
    {
        $product = $doctrine->getRepository(Products::class)->find($id);

        $entityManager = $doctrine->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

        $this->addFlash(
            'success_delete',
            'Votre produit' . $product->getProductName() . 'a bien été suprimé !'
        );

        return $this->redirectToRoute('app_products-admin');
    }
}