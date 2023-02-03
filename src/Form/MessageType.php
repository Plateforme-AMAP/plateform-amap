<?php

namespace App\Form;

use App\Entity\Messages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                "required" => true,
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                "required" => true,
                'attr' => [
                    'class' => 'formField -textArea',
                ]
            ])
            // we get the id with the current user
            // ->add('author')
            // we get the id in the template
            // ->add('contact')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
