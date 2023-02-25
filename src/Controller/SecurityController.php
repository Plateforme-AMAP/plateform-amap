<?php

namespace App\Controller;

use App\Form\ResetPasswordFormType;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ResetPasswordRequestFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;


class SecurityController extends AbstractController
{
    #[Route(path: '/connexion', name: 'app_login-admin')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        //if user is connecter, redirect to the dashboard
        if ($this->getUser()) {
            return $this->redirectToRoute('app_dashboard-admin');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'backOfficeBg' => true]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    // request and create a link for a new password
    #[Route('/recupération', name:'forgotten_password-admin')]
    public function forgottenPassword(
        Request $request,
        UserRepository $usersRepository,
        TokenGeneratorInterface $tokenGenerator,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response
    {
        $form = $this->createForm(ResetPasswordRequestFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // We will look for the user by his email thanks to the fields that we have proposed to him
            $user = $usersRepository->findOneByEmail($form->get('email')->getData());

            // We check if we have a user
            if($user){
                // Generate a token to create a unique link
                $token = $tokenGenerator->generateToken();
                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();

                // Generate a password reset link
                $url = $this->generateUrl('reset_pass-admin', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

                // sending the url with mailer + mime like Verify bundle
                $mailer->send((new TemplatedEmail())
                        ->from(new Address('contact@ho-platform.com', 'Ho Platform'))
                        ->to($user->getEmail())
                        ->subject('Réinitialisation du mot de passe')
                        ->context([
                            'url' => $url,
                            'user'=> $user
                        ])
                        ->htmlTemplate('security/reset_password_email.html.twig')
                );

                // send a success message
                $this->addFlash('success', 'Email envoyé avec succès');
                return $this->redirectToRoute('app_login-admin');
            }

            // if $user is null, we stop the action, return on app_login-admin
            $this->addFlash('danger', 'Un problème est survenu');
            return $this->redirectToRoute('app_login-admin');
        }

        // we send a form for the user to make his password reset request with his email
        return $this->render('security/reset_password.html.twig', [
            'passForm' => $form->createView(),
            'request' => true,
            'backOfficeBg' => true,
            'security' => true
        ]);
    }

    // password change
    #[Route('/recupération/{token}', name:'reset_pass-admin')]
    public function resetPass(
        string $token,
        Request $request,
        UserRepository $usersRepository,
        EntityManagerInterface $entityManager,        
        UserPasswordHasherInterface $userPasswordHasher
    ): Response 
    {
        // we check that the token is in the db of this user
        $user = $usersRepository->findOneByResetToken($token);

        if ($user){
            $form = $this->createForm(ResetPasswordFormType::class);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                // we erase the token
                $user->setResetToken('');

                //recover the password entered by the user
                $user->setPassword(
                    //we hash it
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                    );
                    // then we push it in the db
                    $entityManager->persist($user);
                    $entityManager->flush();

                    $this->addFlash('success', 'mot de passe changé avec succès');
                    return $this->redirectToRoute('app_login-admin');
            }

            // once the link is sent, the user clicks on the link and we send the form to reset the password
            return $this->render('security/reset_password.html.twig', [
                'passForm' => $form->createView(),
                'backOfficeBg' => true
            ]);
        }
        $this->addFlash('danger', 'invalide');
        return $this->redirectToRoute('app_login-admin');
    }
}
