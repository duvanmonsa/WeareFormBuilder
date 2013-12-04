<?php

namespace Weare\FormBuilderBundle\Admin;


use Weare\FormBuilderBundle\Entity\FormBuilderField,
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
class FormBuilderFieldAdmin extends Admin
{
   
    protected $baseRoutePattern = 'formbuilderfield';

   

    /**
* @param \Sonata\AdminBundle\Form\FormMapper $formMapper
*/
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->with('formbuilderfield')
                 ->add('label')
                 ->add('type')
                 ->add('length')
                 ->add('nullable')
                 ->end();
       
    }


    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
    */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
             ->add('label')
                ->add('type');
    }

   

    
}