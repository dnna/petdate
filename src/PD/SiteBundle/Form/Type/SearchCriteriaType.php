<?php

namespace PD\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchCriteriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('breed', 'entity', array('class' => 'PD\SiteBundle\Entity\Breed', 'required' => false, 'empty_value' => 'breed.select'))
            ->add('gender', 'choice', array('required' => true, 'choices' => array(0 => 'gender.male', 1 => 'gender.female')))
            ->add('address', 'text', array('required' => false))
            ->add('latitude', 'hidden', array('required' => false,))
            ->add('longitude', 'hidden', array('required' => false,))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PD\SiteBundle\Entity\SearchCriteria',
            'csrf_protection'   => false,
        );
    }

    public function getName()
    {
        return 'address';
    }
}