<?php

namespace App\Controller;

use App\Entity\Page;
use App\Form\PageType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PagesController extends AbstractController
{ 
    //les dossiers sont gérés dans leurs propres controllers :
    // dossier produits > gérée dans productsController
    // dossier recette > gérée dans recettesController
    // idem dossier producteurs 
    // idem dossier actualités

    #[Route('/', name: 'app_home')]
    public function read(ManagerRegistry $doctrine): Response
    {
        $id = 1;
        $page = $doctrine->getRepository(Page::class)->find($id);

        return $this->render('frontOffice/accueil.html.twig', [
            'page' => $page,
            'pageIncludeTitle' => 'Accueil'
        ]);
    }


    //modification of a page [backOffice]
     #[Route('/admin/accueil/{id}', name: 'edit_page-admin')]
     public function edit($id, Request $request, ManagerRegistry $doctrine): Response
     {
         $page = $doctrine->getRepository(Page::class)->find($id);

         // we enter the date of modification automatically in the form
         $formPage = $this->createForm(PageType::class, $page);
         $formPage->handleRequest($request);

         if ($formPage->isSubmitted() && $formPage->isValid()) {

             $entityManager = $doctrine->getManager();
             $entityManager->flush(); 

             $this->addFlash(
                 'success',
                 'Votre Page ' . $page->getTitle() . ' a bien été modifié !'
             );
             return $this->redirectToRoute('app_products-admin');
         }
         return $this->render('/backOffice/pages/pages.html.twig', [
            'formPage' => $formPage->createView(),
            'formTitle' => 'Page d\'accueil',
            'formSubmitLabel'=> 'Modifier',
            'pageInclude' => 'backOffice/includes/_pageForm.html.twig',
            'pageIncludeTitle' => 'Modifier la page d\'accueil',
         ]);
     }

}
