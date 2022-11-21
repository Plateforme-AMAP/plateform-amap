<?php

namespace App\Controller;

use App\Entity\Products;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PagesController extends AbstractController
{ 
    //les dossiers sont gérés dans leurs propres controllers :
    // dossier produits > gérée dans productController
    // dossier recette > gérée dans recettesController
    // idem dossier producteurs 
    // idem dossier actualités
}
