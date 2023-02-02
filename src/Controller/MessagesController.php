<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Messages;
use App\Form\ContactType;
use App\Form\MessageType;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessagesController extends AbstractController
{
    //to show and interact with messages inside the backoffice [BACKOFFICE]
    #[Route('/admin/dashboard/message/{id}', name: 'app_dashboardMessage-admin')]
    public function add(
        ManagerRegistry $doctrine,
        Request $request,
        EntityManagerInterface $manager,
        MailerInterface $mailer,
        Contact $contact
        ): Response
    {
        $message = new Messages();
        $form = $this->createForm(MessageType::class, $message);

        //to get the current user and put informations in fields
        // if($this->getUser()) {
        //     $message->setAuthor($this->getUser()->getFirstName());
        // }

        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $message = $form->getData();

            $author = $this->getUser();
            $message->setAuthor($author);

            // $recipient = $contact->getId();
            $message->setContact($contact);

            $manager->persist($message);
            $manager->flush();

             //this message tells to the user that his message is recepted
             $mailer->send((new TemplatedEmail())
             ->from(new Address('contact@ho-platform.com', 'Ho Platform'))->to($contact->getEmail())
             ->subject($message->getSubject())
             ->context([
                 'user'=> $contact,
                 'message' => $message->getMessage()
             ])
             ->htmlTemplate('contact/contact_email-response.html.twig')
             );

             $this->addFlash(
                 'success',
                 'Votre message a bien été envoyé !'
             );

            return $this->redirectToRoute('app_products');
        }

        return $this->render('backoffice/pages/dashboard.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}
