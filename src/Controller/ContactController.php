<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(
        Request $request,
        EntityManagerInterface $manager
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

            $this->addFlash(
                'success',
                'Votre message a bien été envoyé !'
            );

            return $this->redirectToRoute('app_products');
        }

        

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
