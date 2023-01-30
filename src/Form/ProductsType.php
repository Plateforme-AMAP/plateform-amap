<?php

namespace App\Form;

use App\Entity\Unity;
use App\Entity\Category;
use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productName', TextType::class, [
                "required" => true,
                'label' => 'Nom du produit'
            ])
            ->add('productDescription', TextareaType::class, [
                'label' => 'Description du produit'
            ])
            ->add('productPrice', MoneyType::class, [
                'divisor' => 100,
                "required" => true,
                'label' => 'Prix du produit'
            ])
            ->add('imageFile', VichImageType::class, [
                "label" => 'Image du produit',
                "required" => false,
                "imagine_pattern" => 'min',
                'allow_delete' => true,
                'delete_label' => 'Suprimer l\'image',
            ])
            ->add('unityValue', TextType::class, [
                "required" => true,
                'label' => 'Quantité',
            ])
            ->add('unity', EntityType::class, [
                // looks for choices from this entity
                'class' => Unity::class,
                'label' => 'Unité',
                'choice_label' => 'libelle', //on affiche tout les champs de la classe en option, ce qui est dans "libellé"
                'placeholder' => 'Choisir une unité de mesure',
            ])
            ->add('category', EntityType::class, [
                // looks for choices from this entity
                'class' => Category::class,
                'label' => 'Type',
                'choice_label' => 'name', //on affiche tout les champs de la classe en option, ce qui est dans "libellé"
                'placeholder' => 'Type d\'article',
            ])
            ->add('state', ChoiceType::class, [
                'label' => 'Statut de l\'article',
                'choices'  => [
                    'Hors ligne' => 0,
                    'En ligne' => 1,
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}