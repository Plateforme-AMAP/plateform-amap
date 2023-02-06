<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Inscription;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    //to show inscriptions [BACKOFFICE]
    #[Route('/admin/dashboard', name: 'app_dashboard-admin')]
    public function read(ManagerRegistry $doctrine): Response
    {
        $inscriptions = $doctrine->getRepository(Inscription::class)->findBy([], ['id' => 'DESC']);

        $contacts = $doctrine->getRepository(Contact::class)->findBy([], ['id' => 'DESC']);

        return $this->render('backOffice/pages/dashboard.html.twig', [
            'inscriptions' => $inscriptions,
            'contacts' => $contacts,
            'pageIncludeTitle' => 'Dashboard'
        ]);
    }

}