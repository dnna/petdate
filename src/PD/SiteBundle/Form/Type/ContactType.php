<?php

namespace PD\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = array())
    {
        $builder
            ->add('location', 'choice', array('required' => true, 'label' => 'contact.location.label', 'choices' => array('mine' => 'contact.location.mine', 'their' => 'contact.location.their')))
            ->add('puppies', 'choice', array('required' => true, 'label' => 'contact.puppies.label', 'choices' => range(0, 10)))
            ->add('message', 'textarea', array('label' => 'contact.message.label', 'attr' => array('style' => 'height: 113px; width: 300px;', 'placeholder' => 'contact.message.placeholder')))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PD\SiteBundle\Entity\Contact',
            'csrf_protection' => false,
        );
    }

    public function getName()
    {
        return 'contact';
    }
}