<?php

namespace PD\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //parent::buildForm($builder, $options);

        $builder
            ->add('email', 'email', array('error_bubbling' => true))
            ->add('plainPassword', 'repeated', array(
                'first_name' => 'pass',
                'second_name' => 'confirm',
                'type' => 'password',
                'error_bubbling' => true,
            ))
        ;
    }

    public function getName()
    {
        return 'pd_user_registration';
    }
}
