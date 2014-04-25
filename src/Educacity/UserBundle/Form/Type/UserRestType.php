<?php
namespace Educacity\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserRestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email')
            ->add('password', 'password');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Educacity\UserBundle\Entity\User',
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Educacity\UserBundle\Entity\User',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'user';
    }
}