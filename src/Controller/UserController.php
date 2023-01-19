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
    #[Route('/admin/compte', name: 'app_user-admin')]
    public function read(): Response
    {
        // to display user information, nothing to send
        return $this->render('user/account.html.twig', [
            'accountTitle' => 'Mes informations'
        ]);
    }
        
    #[Route('/admin/compte/modifier/{id}', name: 'app_userEdit-admin')]
    public function edit(User $user, Request $request,  EntityManagerInterface $manager): Response
    {
        // Check if the user is logged in
        if(!$this->getUser()) {
            // if he's not we send the user on the login page
            return $this->redirectToRoute('app_login');
        }

        // Check if the user is the one who modifies his profile
        if($this->getUser() !== $user) {
            // if he's not we send the user out of the backoffice, on the products page
            return $this->redirectToRoute('app_products');
        }

        // once this informations were been verified we create a form (to see the details and secure the fields see Form > UserType )
        $form = $this->createForm(UserType::class, $user);

        // Used to manage the processing of form input.
        $form->handleRequest($request);

        // test if the form has been entered and if the validation rules are checked
        if($form->isSubmitted() && $form->isValid()) {
            // Doctrine is asked to monitor/manage the current object
            $user = $form->getData();
            //new data is recorded
            $manager->persist($user);
            // we send the data to replace them
            $manager->flush();

            // We send a confirmation message (recover by a piece of html on the template side))
            $this->addFlash('success', 'les informations de votre compte ont bien été modifiées');

            // We told where to go once the data has changed
            return $this->redirectToRoute('app_user-admin');
        }

        // We send all edit/deletion forms on the same page : account.html.twig
        return $this->render('user/account.html.twig', [
            'userForm' => $form->createView(),
            'accountTitle' => 'Modifier mes informations'
        ]);
    }

    // for reset forgotten password 
    #[Route('/admin/compte/demande-de-suppression/{id}', name:'app_userDelete_request-admin')]
    public function deleteRequest(
        User $user,
        TokenGeneratorInterface $tokenGenerator,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response
    {
        // Check if the user is logged in
        if(!$this->getUser()) {
            // if he's not we send the user on the login page
            return $this->redirectToRoute('app_login');
        }

        // Check if the user is the one who modifies his profile
        if($this->getUser() !== $user) {
            // if he's not we send the user out of the backoffice, on the products page
            return $this->redirectToRoute('app_products');
        }

            // a unique token is generated and sent to the database
            $token = $tokenGenerator->generateToken();
            $user->setResetToken($token);
            $entityManager->persist($user);
            $entityManager->flush();

            // thanks to this one creates a unique link for the user
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

            // We send the user the account page with the permanent deletion button
            $this->addFlash('success', 'Un email vous a été envoyé pour supprimer votre compte');
            return $this->render('user/account.html.twig', [
                'accountTitle' => 'Un lien vous a été envoyé',
                'emailSend' => true,
            ]);
    }

    // user account deletion page, the link is created above
    #[Route('/admin/compte/suppression/{token}', name: 'app_userPageDelete')]
    public function deletePage() : Response
    {
        return $this->render('user/account.html.twig', [
            'deleteAutorisation' => true,
            'accountTitle' => 'Suppression du compte'
        ]);
    }

    // account deletion
    #[Route('/admin/suppression/{id}', name: 'app_userDelete-admin')]
    public function delete($id, User $user, ManagerRegistry $doctrine, MailerInterface $mailer) : RedirectResponse
    {
        // Check if the user is logged in
        if(!$this->getUser()) {
            // if he's not we send the user on the login page
            return $this->redirectToRoute('app_login');
        }

        // Check if the user is the one who modifies his profile
        if($this->getUser() !== $user) {
            // if he's not we send the user out of the backoffice, on the products page
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

        // we call the doctrine to retrieve the user's id
        $user = $doctrine->getRepository(User::class)->find($id);

        // we delete and send to the database
        $entityManager = $doctrine->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        // finally we empty the session (because our user is registered)
        $session = new Session();
        $session->invalidate();

        return $this->redirectToRoute('app_products');
    }
}
