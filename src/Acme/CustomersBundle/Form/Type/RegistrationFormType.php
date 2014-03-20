<?php

namespace Acme\CustomersBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends BaseType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    // public function __construct($class)
    // {
    //     $this->class = $class;
    // }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('name', null, array('label'=> 'First name'))
            ->add('surname', null, array('label'=> 'Last name'))
            ->add('skype', null, array('label'=> 'Skype', 'required'=>false))
            ->add('linkedin', null, array('label'=> 'LinkedIn', 'required'=>false))
            ->add('fb', null, array('label'=> 'FaceBook', 'required'=>false))
            ->add('site', null, array('label'=> 'Web-site', 'required'=>false))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'Retry password'),//'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
                )
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => "Acme\CustomersBundle\Document\Client",
            'intention'  => 'registration',
        ));
    }

    public function getName()
    {
        return 'acme_customers_registration';
    }
}
