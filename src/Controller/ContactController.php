<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function add(
        Request $request,
        EntityManagerInterface $manager,
        MailerInterface $mailer
        ): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        //to get the current user and put informations in fields
        // if($this->getUser()) {
        //     $contact->setFullName($this->getUser()->getFullName())->setEmail($this->getUser()->getEmail());
        // }

        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();


                // sending the url with mailer + mime like Verify bundle
                //this message tells to the user that his message is recepted
                $mailer->send((new TemplatedEmail())
                ->from(new Address('contact@ho-platform.com', 'Ho Platform'))->to($contact->getEmail())
                ->subject('Nous avons bien reçu votre message')
                ->context([
                    'user'=> $contact->getFullName(),
                ])
                ->htmlTemplate('contact/contact_email-request.html.twig')
                );

                $this->addFlash(
                    'success',
                    'Votre message a bien été envoyé !'
                );

            return $this->redirectToRoute('app_products');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    //to show and interact with messages inside the backoffice [BACKOFFICE]
    #[Route('/admin/dashboard', name: 'app_dashboard-admin')]
    public function read(ManagerRegistry $doctrine): Response
    {
        $contacts = $doctrine->getRepository(Contact::class)->findBy([], ['id' => 'DESC']);

        return $this->render('backOffice/pages/dashboard.html.twig', [
            'contacts' => $contacts,
            'status' => 'frontOffice',
            'pageIncludeTitle' => 'Dashboard'
        ]);
    }

    //delete messages from contacts [BACKOFFICE]
    #[Route('/admin/dashboard/supprimer/{id}', name: 'delete_contactMessage-admin')]
    public function delete($id, ManagerRegistry $doctrine) : RedirectResponse
    {
        $contactMessage = $doctrine->getRepository(Contact::class)->find($id);

        $entityManager = $doctrine->getManager();
        $entityManager->remove($contactMessage);
        $entityManager->flush();

        //for the contact message the only deletion security in V1 is in the template via a confirmation alert
        $this->addFlash(
            'success',
            'Le message de ' . $contactMessage->getFullName() . ' a bien été supprimé !'
        );

        return $this->redirectToRoute('app_dashboard-admin');
    }
}
