<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Products;
use App\Form\ProductsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{
    // Affichage de tout les produits
    #[Route('/produits', name: 'app_products')]
    public function readAll(ManagerRegistry $doctrine): Response
    {
        $products = $doctrine->getRepository(Products::class)->findBy([], ['id' => 'DESC']);

        return $this->render('products/products.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/produits/{id}', name: 'details_product')]
    public function read($id, ManagerRegistry $doctrine): Response
    {
        $product = $doctrine->getRepository(Products::class)->find($id);
        $products = $doctrine->getRepository(Products::class)->findAll();

        return $this->render('products/details_product.html.twig', [
            'products' => $products,
            'product' => $product,
        ]);
    }

     //create
     #[Route('/admin/ajouter', name: 'add_product')]
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
             return $this->redirectToRoute('app_products');
         }
         // On envois la page avec le formulaire et on permet la création de la vue (qu'on appellera dans le template)
         return $this->render('products/form_product.html.twig', [
             'formProduct' => $formProduct->createView(),
             'formTitle' => 'Ajouter un bien',
             'formSubmitLabel'=> 'Ajouter',
         ]);
     }
}