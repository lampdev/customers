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
            ->add('docs','url')
            ->add('topublic')
        ;
    }

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('user')
                ->add('description','textarea')
                ->add('file','file',array('required' => false,'label'=>'File: (pdf/html/gif/jpeg/png)'))
                ->add('docs','url',array('required'=>false, 'disabled'=>true))
                ->add('topublic', 'checkbox', array(
                                                'label'     => 'Show publicly',
                                                'required'  => false,
                                            ))
            ->end()
        ;
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('user')
            ->add('description','textarea')
            ->add('docs','url')
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

    public function prePersist($report) {
        $this->saveFile($report);
    }

    public function preUpdate($report) {
        $this->saveFile($report);
    }

    public function saveFile($report) {
        $basepath = $this->getRequest()->getBasePath();
        $report->upload($basepath);
    }
}