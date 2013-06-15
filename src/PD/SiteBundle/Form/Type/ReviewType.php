<?php

namespace PD\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('message', 'textarea', array('required' => true, 'label' => 'review.message.label', 'attr' => array('placeholder' => 'review.message.placeholder')))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PD\SiteBundle\Entity\Review',
            'csrf_protection' => false,
        );
    }

    public function getName()
    {
        return 'review';
    }
}