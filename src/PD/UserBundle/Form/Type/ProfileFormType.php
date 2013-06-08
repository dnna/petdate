<?php
namespace PD\UserBundle\Form\Type;

use PD\SiteBundle\Form\Type\DogType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array('required' => true))
            ->add('email', 'email', array('required' => true))
            ->add('address', 'text', array('required' => false))
            ->add('latitude', 'hidden', array('required' => false,))
            ->add('longitude', 'hidden', array('required' => false,))
        ;
    }

    public function getName()
    {
        return 'pd_user_profile';
    }
}
