<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'required' => true,
                'label' => 'Nom et prénom',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre nom et prénom doivent faire au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Email',
            ])
            ->add('subject', TextType::class, [
                'required' => true,
                'label' => 'Sujet',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre sujet doit faire au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 100,
                    ])
                ]
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'label' => 'Message',
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre message doit faire au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 2000,
                    ])
                ],
                'attr' => [
                    'class' => 'formField -textArea',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
