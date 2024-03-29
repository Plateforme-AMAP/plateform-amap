<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StyleguideController extends AbstractController
{
    #[Route('/styleguide', name: 'app_styleguide')]
    public function index(): Response
    {
        return $this->render('styleguide/index.html.twig', [
            'controller_name' => 'Styleguide',
        ]);
    }
}
