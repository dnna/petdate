<?php

namespace PD\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('photo', 'file', array('required' => false))
            ->add('name', 'text', array('required' => true))
            ->add('breed', null, array('required' => true,))
            ->add('gender', 'choice', array('required' => true, 'choices' => array(0 => 'gender.male', 1 => 'gender.female')))
            ->add('color', null, array('required' => true))
            ->add('birthyear', 'date', array('required' => true))
            ->add('description', 'textarea', array('required' => true))
            ->add('vaccinations', 'textarea', array('required' => true))
            ->add('diseases', 'textarea', array('required' => true))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PD\SiteBundle\Entity\Dog',
            'csrf_protection'   => false,
        );
    }

    public function getName()
    {
        return 'dog';
    }
}