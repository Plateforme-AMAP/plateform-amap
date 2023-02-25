<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => true,
                'label' => 'Prénom',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doivent faire au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ])
                ]
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
                'label' => 'Nom',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doivent faire au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ])
                ]
            ])
            ->add('adress', TextType::class, [
                'required' => true,
                'label' => 'Adresse',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre Adresse doivent faire au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ])
                ]
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code postal',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/^(?:0[1-9]|[1-8]\d|9[0-8])\d{3}$/')
                ],
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'label' => 'Ville',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom de votre ville doit faire au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Email',
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de téléphone',
                'constraints' => [
                    new NotBlank(),
                    new Regex("/^[+]?(?:\(\d+(?:\.\d+)?\)|\d+(?:\.\d+)?)(?:[ -]?(?:\(\d+(?:\.\d+)?\)|\d+(?:\.\d+)?))*(?:[ ]?(?:x|ext)\.?[ ]?\d{1,5})?$/"),
                ],
            ])
            ->add('basket', ChoiceType::class, [
                'label' => 'Panier',
                'choices'  => [
                    'un panier de légumes/semaine pour 1 personne' => 'Petit',
                    'un panier de légumes/semaine pour 2 personnes' => 'Moyen',
                    'un panier de légumes/semaine pour 4/5 personnes' => 'Grand',
                ],
            ])
            ->add('bonusProduct', ChoiceType::class, [
                'label' => 'Panier',
                'choices'  => [
                    'Aucun' => null,
                    'Confiture de saison - 200ml' => 'Confiture de saison - 200ml',
                    'Oeufs x6' => 'Oeufs x6',
                    'Oeufs x12' => 'Oeufs x12',
                    'Lait x6L' => 'Lait x6L',
                ],
            ])
            ->add('member', ChoiceType::class, [
                'label' => 'Membre',
                'choices'  => [
                    'Pas encore membre' => false,
                    'Déjà membre' => true,
                ],
            ])
            ->add('generalCommitments', CheckboxType::class, [
                'label'    => 'Conditions générales',
                'required' => true,
            ])
            ->add('payment', ChoiceType::class, [
                'label' => 'Moyen de paiement',
                'required' => true,
                'choices'  => [
                    'Chèque' => 'Chèque',
                    'Virement' => 'Virement banquaire',
                    'Paypal' => 'Paypal',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
