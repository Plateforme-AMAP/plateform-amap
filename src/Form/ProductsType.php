<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}