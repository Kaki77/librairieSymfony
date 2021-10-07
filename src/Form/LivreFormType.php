<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class LivreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isbn',NumberType::class,['label'=>'ISBN','html5'=>true])
            ->add('titreLivre',TextType::class,['label'=>'Titre'])
            ->add('idThemeLivre',null,['label'=>'Thème'])
            ->add('nomAuteur',TextType::class,['label'=>'Nom Auteur'])
            ->add('prenomAuteur',TextType::class,['label'=>'Prénom Auteur'])
            ->add('idFormatLivre',null,['label'=>'Format'])
            ->add('pageLivre',NumberType::class,['label'=>'Nombre de pages','html5'=>true])
            ->add('idEditeur',null,['label'=>'Editeur'])
            ->add('anneeEdition',TextType::class,['label'=>'Année d\'édition'])
            ->add('idLangue',null,['label'=>'Langue'])
            ->add('prixLivre',TextType::class,['label'=>'Prix'])
            ->add('quantite',NumberType::class,['label'=>'Quantité','html5'=>true])
            ->add('imageLivre',FileType::class,['label'=>'Image','mapped'=>false,'required'=>false,'constraints' =>[
                new File(
                    [
                        'maxSize' => '2048k',
                        'mimeTypes' =>
                        [
                            'image/jpeg',
                            'image/png'
                        ],
                    'mimeTypesMessage' => 'Please upload a valid JPG or PNG image',
                    ])
                ],
            ]);
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
