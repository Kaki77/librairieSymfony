<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mailUser',EmailType::class,['label'=>'Mail'])
            ->add('roles', ChoiceType::class, array(
            'attr'  =>  array('class' => 'form-control',
            'style' => 'margin:5px 0;'),
            'choices' => array
            (
                'ROLE_ADMIN' => array
                (
                    'Yes' => 'ROLE_ADMIN',
                ),
                'ROLE_USER' => array
                (
                    'Yes' => 'ROLE_USER'
                )
            ) ,'multiple' => true,'required' => true,))
            ->add('password',PasswordType::class,['label'=>'Mot de passe'])
            ->add('nomUser',TextType::class,['label'=>'Nom'])
            ->add('prenomUser',TextType::class,['label'=>'Prénom']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
