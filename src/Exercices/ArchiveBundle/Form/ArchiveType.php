<?php

namespace Exercices\ArchiveBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArchiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('title', TextType::class, array('label' => 'Insérer votre titre'))
      		->add('description',TextType::class, array('label' => 'Ajouter une description'))
        	->add('link', FileType::class, array('label' => 'Déposer votre fichier'))
        	->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Exercices\ArchiveBundle\Entity\Archive',
        ));
    }
}