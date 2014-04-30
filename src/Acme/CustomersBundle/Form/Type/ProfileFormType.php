<?php

namespace Acme\CustomersBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword as OldUserPassword;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends BaseType
{

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\CustomersBundle\Document\Client',
            'intention'  => 'profile',
        ));
    }

    public function getName()
    {
        return 'acme_customers_profile';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('name', null, array('label'=> 'First name'))
            ->add('surname', null, array('label'=> 'Last name'))
            ->add('skype', null, array('label'=> 'Skype', 'required'=>false))
            ->add('linkedin', null, array('label'=> 'LinkedIn', 'required'=>false))
            ->add('fb', null, array('label'=> 'FaceBook', 'required'=>false))
            ->add('site', null, array('label'=> 'Web-site', 'required'=>false))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
        ;
    }
}
