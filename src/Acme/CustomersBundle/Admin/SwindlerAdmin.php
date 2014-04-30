<?php

namespace Acme\CustomersBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SwindlerAdmin extends Admin
{
  //  protected $baseRouteName = 'sonata_post';
    protected $baseRoutePattern = 'swindler';

    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('surname')
            ->add('companyname')
            ->add('description')
            ->add('photolink','url')
            ->add('topublic')
        ;
    }

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('name')
                ->add('surname')
                ->add('companyname')
                ->add('description','textarea')
                ->add('contacts')
                ->add('file','file',array('required' => false,'label'=>'File: (pdf/html/gif/jpeg/png)'))
                ->add('photolink','url',array('required'=>false, 'disabled'=>true))
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
            ->add('name')
            ->add('surname')
            ->add('companyname')
            ->add('description','textarea')
            ->add('contacts')
            ->add('photolink','url',array('asd'=>true))
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
            ->add('name')
            ->add('surname')
            ->add('companyname')
            ->add('contacts')
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