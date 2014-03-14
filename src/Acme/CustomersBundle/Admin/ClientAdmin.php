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

    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('login')
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('skype')
            ->add('linkedin')
            ->add('fb')
            ->add('site')
        ;
    }

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('login')
                ->add('name')
                ->add('surname')
                ->add('email')
                ->add('skype')
                ->add('linkedin')
                ->add('fb')
                ->add('site')
            ->end()
        ;
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('login')
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
            ->add('login')
            ->add('name')
            ->add('surname')
        ;
    }
}