<?php

namespace App\Controller;

use App\Entity\Inscription;
use DateTimeImmutable;
use App\Form\InscriptionType;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

         // creation of a product [backOffice]
         #[Route('/inscription', name: 'app_inscription')]
         public function create(Request $request, ManagerRegistry $doctrine): Response
         {
             $inscription = new Inscription();
    
             $inscription->setInscriptionCreatedAt(new DateTimeImmutable());
             $formInscription = $this->createForm(InscriptionType::class, $inscription);
             $formInscription->handleRequest($request);
    
             if ($formInscription->isSubmitted() && $formInscription->isValid()) {
    
                 $entityManager = $doctrine->getManager();
                 $entityManager->persist($inscription);
                 $entityManager->flush(); 
    
                 $this->addFlash(
                     'success',
                     'Merci ' . $inscription->getFirstName() . ' ! votre inscription a bien été envoyée !'
                 );
                 return $this->redirectToRoute('app_products-admin');
             }
             // We send the page with the form and we allow the creation of the view (which we will call in the template)
             return $this->render('/inscription/inscription.html.twig', [
                'formInscription' => $formInscription->createView(),
             ]);
        }
}
