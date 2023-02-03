<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'required' => true,
                'label' => 'Prénom',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doit faire au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ]
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'label' => 'Nom',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre nom doit faire au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ]
            ])
            ->add('email', EmailType::class)
            ->add('plainPassword', RepeatedType::class, [ 
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne sont pas identiques.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer le mot de passe'],
                'mapped' => false,
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                 //pour dire que le champs n'est pas lié dans l'entité -> donc pas dans la bdd
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
