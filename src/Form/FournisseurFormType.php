<?php

namespace App\Form;

use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class FournisseurFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeFournisseur',TextType::class,['label'=>'Code Fournisseur'])
            ->add('raisonSociale',TextType::class,['label'=>'Raison Sociale'])
            ->add('adresse',TextType::class,['label'=>'Adresse'])
            ->add('codePostal',TextType::class,['label'=>'Code Postal'])
            ->add('ville',TextType::class,['label'=>'Ville'])
            ->add('pays',TextType::class,['label'=>'Pays'])
            ->add('telephone',TextType::class,['label'=>'Téléphone'])
            ->add('site',TextType::class,['label'=>'Site'])
            ->add('mail',EmailType::class,['label'=>'Mail'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fournisseur::class,
        ]);
    }
}
