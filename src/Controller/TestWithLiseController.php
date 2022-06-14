<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestWithLiseController extends AbstractController
{
    #[Route('/test/with/lise', name: 'app_test_with_lise')]
    public function index(): Response
    {
        return $this->render('test_with_lise/index.html.twig', [
            'controller_name' => 'TestWithLiseController',
        ]);
    }
}
