<?php

namespace Weare\FormBuilderBundle\Admin;


use Weare\FormBuilderBundle\Entity\FormBuilder,
    Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Validator\ErrorElement,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection,
    Doctrine\ORM\EntityRepository
     ;
use Sonata\AdminBundle\Exception\ModelManagerException;

/**
* @author weare
*/
class FormBuilderAdmin extends Admin
{
   
    protected $baseRoutePattern = 'formbuilder';
    protected $translationDomain = 'WeareFormBuilderBundle';

   

    /**
* @param \Sonata\AdminBundle\Form\FormMapper $formMapper
*/
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->with('formbuilder')
                ->add('name')
                ->add('description')
                ->add('email')
                ->add('submit',null,array('label'=>'title_submit'))
                 ->add('fields', 'sonata_type_collection',
                         array(
                                'required' => false,
                                'by_reference' => false
                            ),
                            array(
                                'edit' => 'inline',
                                'inline' => 'table',
                                'allow_delete' => true
                            ))
                ->end();
       
    }
    
     public function prePersist($formbuilder)
    {
      foreach($formbuilder->getFields() as $field)
      {
          $field->setForm($formbuilder);
      }
        
    }
   
 
public function preUpdate($formbuilder)
{
    foreach($formbuilder->getFields() as $field)
      {
          $field->setForm($formbuilder);
      }
   //$formbuilder->setFields($formbuilder->getFields());
   
}

    /**
* @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
*/
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

        $datagridMapper
                 ->add('name')
                 ->add('description')
                ;
    }

    /**
* @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
*/
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description');
    }

   

    
}