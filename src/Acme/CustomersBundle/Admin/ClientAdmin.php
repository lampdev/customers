<?php

namespace Acme\CustomersBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ClientAdmin extends Admin
{
  //  protected $baseRouteName = 'sonata_post';
    protected $baseRoutePattern = 'client';

    // public function configureShowFields(ShowMapper $showMapper)
    // {
    //     $showMapper
    //         ->add('username')
    //         ->add('roles')
    //         ->add('name')
    //         ->add('surname')
    //         ->add('email')
    //         ->add('skype')
    //         ->add('linkedin')
    //         ->add('fb')
    //         ->add('site')
    //     ;
    // }

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('username')
                ->add('name')
                ->add('surname')
                ->add('email')
                ->add('skype', null, array('label'=> 'Skype', 'required'=>false))
                ->add('linkedin', null, array('label'=> 'LinkedIn', 'required'=>false))
                ->add('fb', null, array('label'=> 'FaceBook', 'required'=>false))
                ->add('site', null, array('label'=> 'Web-site', 'required'=>false))
            ->end()
        ;
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('roles', 'array')
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('skype')
            ->add('linkedin')
            ->add('fb')
            ->add('site')
            ->add('_action','action', array(
                'actions'=>array(
                    'edit'=>array(),
                    'delete'=>array()
                    )
                ))
        ;
    }

    public function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('name')
            ->add('surname')
        ;
    }
}