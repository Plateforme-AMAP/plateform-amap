<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/admin/compte/{id}', name: 'app_user')]
    public function edit(User $user, Request $request,  EntityManagerInterface $manager): Response
    {
        //we check if the user in connected
        if(!$this->getUser()) {
            // if he's not we send the user on the login page
            return $this->redirectToRoute('app_login');
        }

        //we check if the user is the account's user
        if($this->getUser() !== $user) {
            // if he's not we send the user on the products page
            return $this->redirectToRoute('app_products');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'les informations de votre compte ont bien été modifiées');

            return $this->redirectToRoute('app_products-admin');
        }

        return $this->render('user/edit_account.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }
}
