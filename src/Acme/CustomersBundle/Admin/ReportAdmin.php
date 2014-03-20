<?php

namespace Acme\CustomersBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ReportAdmin extends Admin
{
  //  protected $baseRouteName = 'sonata_post';
    protected $baseRoutePattern = 'report';

    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('user')
            ->add('description')
            ->add('docs')
            ->add('topublic')
        ;
    }

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('user')
                ->add('description')
                ->add('docs','iphp_file',array('required' => false))
                ->add('topublic')
            ->end()
        ;
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('user')
            ->add('description')
            ->add('docs')
            ->add('topublic', 'boolean')
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
            ->add('user')
            ->add('topublic')
        ;
    }
}