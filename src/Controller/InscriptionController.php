<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Inscription;
use App\Form\InscriptionType;
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
                     'Merci ' . $inscription->getFirstName() . ' ! votre inscription a bien été soumise !'
                 );
                 return $this->redirectToRoute('app_products');
             }
             // We send the page with the form and we allow the creation of the view (which we will call in the template)
             return $this->render('/inscription/inscription.html.twig', [
                'formInscription' => $formInscription->createView(),
             ]);
        }

        //to show inscriptions details [BACKOFFICE]
        #[Route('/admin/dashboard/inscription/{id}', name: 'app_inscriptionDetail-admin')]
        public function read($id, ManagerRegistry $doctrine): Response
        {
            $inscription = $doctrine->getRepository(Inscription::class)->find($id);

            $title = 'Inscription de ' . $inscription->getFirstName();

            return $this->render('backOffice/pages/dashboard.html.twig', [
                'inscription' => $inscription,
                'pageIncludeTitle' => $title,
            ]);
        }

        //suppression d'une inscription [BACKOFFICE]
        #[Route('/admin/inscription/supprimer/{id}', name: 'delete_inscription-admin')]
        public function delete($id, ManagerRegistry $doctrine) : RedirectResponse
        {
            $inscription = $doctrine->getRepository(Inscription::class)->find($id);

            $entityManager = $doctrine->getManager();
            $entityManager->remove($inscription);
            $entityManager->flush();

            //for the inscription the only deletion security in V1 is in the template via a confirmation alert
            $this->addFlash(
                'success',
                'l\'inscription a bien été supprimée !'
            );

            return $this->redirectToRoute('app_dashboard-admin');
        }
}
