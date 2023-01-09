<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\HttpFoundation\Session\Session;


class UserController extends AbstractController
{
    #[Route('/admin/compte', name: 'app_user')]
    public function read(): Response
    {
        return $this->render('user/account.html.twig', [
            'accountTitle' => 'Mes informations'
        ]);
    }
        
    #[Route('/admin/compte/modifier/{id}', name: 'app_userEdit')]
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

        return $this->render('user/account.html.twig', [
            'userForm' => $form->createView(),
            'accountTitle' => 'Modifier mes informations'
        ]);
    }

    // for reset forgotten password 
    #[Route('/admin/compte/demande-de-suppression/{id}', name:'app_userDelete_request')]
    public function deleteRequest(
        User $user,
        TokenGeneratorInterface $tokenGenerator,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response
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

            // On génère un token pour la suppression
            $token = $tokenGenerator->generateToken();
            $user->setResetToken($token);
            $entityManager->persist($user);
            $entityManager->flush();

            // On génère un lien de suppression du compte
            $url = $this->generateUrl('app_userPageDelete', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

            //sending the url with mailer + mime like Verify bundle
            $mailer->send((new TemplatedEmail())
                    ->from(new Address('contact@ho-platform.com', 'Ho Platform'))
                    ->to($user->getEmail())
                    ->subject('Demande de suppression de votre compte')
                    ->context([
                        'url' => $url,
                        'user'=> $user,
                    ])
                    ->htmlTemplate('user/delete_account_email.html.twig')
            );

            $this->addFlash('success', 'Un email vous a été envoyé pour supprimer votre compte');
            return $this->render('user/account.html.twig', [
                'accountTitle' => 'Un lien vous a été envoyé',
                'emailSend' => true,
            ]);
    }

    //page de suppression d'un compte utilisateur
    #[Route('/admin/compte/suppression/{token}', name: 'app_userPageDelete')]
    public function deletePage() : Response
    {
        return $this->render('user/account.html.twig', [
            'deleteAutorisation' => true,
            'accountTitle' => 'Suppression du compte'
        ]);
    }

    //suppression du compte
    #[Route('/admin/suppression/{id}', name: 'app_userDelete')]
    public function delete($id, User $user, ManagerRegistry $doctrine, MailerInterface $mailer) : RedirectResponse
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

        // we send a last mail to confirm the suppression
        $mailer->send((new TemplatedEmail())
            ->from(new Address('contact@ho-platform.com', 'Ho Platform'))
            ->to($user->getEmail())
            ->subject('Suppression de votre compte')
            ->context([
                'user'=> $user
            ])
            ->htmlTemplate('user/delete_account_confirmation_email.html.twig')
            );

        $user = $doctrine->getRepository(User::class)->find($id);

        $entityManager = $doctrine->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        $session = new Session();
        $session->invalidate();

        return $this->redirectToRoute('app_products');
    }
}
