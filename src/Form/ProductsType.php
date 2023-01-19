<?php

namespace App\Form;

use App\Entity\Products;
use App\Entity\Unity;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            ->add('productPrice', NumberType::class, [
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
            ])
            ->add('category', EntityType::class, [
                // looks for choices from this entity
                'class' => Category::class,
                'label' => 'Type',
                'choice_label' => 'name', //on affiche tout les champs de la classe en option, ce qui est dans "libellé"
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