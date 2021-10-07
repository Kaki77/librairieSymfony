<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroCommande',TextType::class,['label'=>'Numéro de commande'])
            ->add('idLivre',null,['label'=>'Livre'])
            ->add('idFournisseur',null,['label'=>'Fournisseur'])
            ->add('dateCommande',TextType::class,['label'=>'Date de Commande'])
            ->add('prixCommande',TextType::class,['label'=>'Prix'])
            ->add('nombreExemplaire',TextType::class,['label'=>'Nombre d\'exemplaires'])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
