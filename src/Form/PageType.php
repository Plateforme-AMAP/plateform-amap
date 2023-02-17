<?php

namespace App\Form;

use App\Entity\Page;
use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom de la page'
            ])
            ->add('subtitle', TextType::class, [
                'label' => 'Sous-titre'
            ])
            ->add('subtitle2', TextType::class, [
                'label' => 'Sous-titre 2 ( optionnel )',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('imageFile', VichImageType::class, [
                "label" => 'Image principale',
                "required" => false,
                "imagine_pattern" => 'min',
                'allow_delete' => true,
                'delete_label' => 'Supprimer l\'image',
            ])
            ->add('featuredProduct', EntityType::class, [
                // looks for choices from this entity
                'class' => Products::class,
                'choice_label' => 'product_name', //on affiche tout les champs de la classe en option, ce qui est dans "libellé"
                'placeholder' => 'Choisir un produit phare',
            ])

            // ->add('valueSectionTitle', TextType::class, [
            //     'label' => 'Titre de la section informations',
            // ])
            // ->add('valueSectionSubtitle', TextType::class, [
            //     'label' => 'Sous-titre de la section',
            // ])

            // ->add('value1Title', TextType::class, [
            //     'label' => 'Titre colonne 1',
            // ])
            // ->add('value1ImageName', VichImageType::class, [
            //     "label" => 'Image colonne 1',
            //     "imagine_pattern" => 'min',
            //     'allow_delete' => true,
            //     'delete_label' => 'Supprimer l\'image',
            // ])
            // ->add('value1Description', TextareaType::class, [
            //     'label' => 'Sous-titre colonne 1',
            // ])
            // ->add('value2Title', TextType::class, [
            //     'label' => 'Titre colonne 1',
            // ])
            // ->add('value2ImageName', VichImageType::class, [
            //     "label" => 'Image colonne 1',
            //     "imagine_pattern" => 'min',
            //     'allow_delete' => true,
            //     'delete_label' => 'Supprimer l\'image',
            // ])
            // ->add('value2Description', TextareaType::class, [
            //     'label' => 'Sous-titre colonne 1',
            // ])
            // ->add('value3Title', TextType::class, [
            //     'label' => 'Titre colonne 1',
            // ])
            // ->add('value3ImageName', VichImageType::class, [
            //     "label" => 'Image colonne 1',
            //     "imagine_pattern" => 'min',
            //     'allow_delete' => true,
            //     'delete_label' => 'Supprimer l\'image',
            // ])
            // ->add('value3Description', TextareaType::class, [
            //     'label' => 'Sous-titre colonne 1',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}