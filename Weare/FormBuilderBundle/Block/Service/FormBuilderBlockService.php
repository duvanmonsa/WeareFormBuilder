<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Weare\FormBuilderBundle\Block\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Weare\FormBuilderBundle\Model\FormBuilderManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Templating\EngineInterface;

class FormBuilderBlockService extends BaseBlockService {

    protected $formBuilderAdmin;
    
    public function __construct($name, EngineInterface $templating, ContainerInterface $container, FormBuilderManagerInterface $formbuilderManager)
    {
        parent::__construct($name, $templating);

        $this->formbuilderManager = $formbuilderManager;
        $this->container      = $container;
    }
    
     public function getName()
    {
        return 'Form Builder';
       }
    function setDefaultSettings(OptionsResolverInterface $resolver) {
        
                
        $resolver->setDefaults(array(
            'title' => false,
            'formbuilder' => false,
            'template' => 'WeareFormBuilderBundle:Block:block_core_formbuilder.html.twig',
            'formbuilderId'    => false
        ));
        
        
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block) {
        
       
        // simulate an association ...
        $fieldDescription = $this->getFormBuilderAdmin()->getModelManager()->getNewFieldDescriptionInstance($this->getFormBuilderAdmin()->getClass(), 'field' );
        $fieldDescription->setAssociationAdmin($this->getFormBuilderAdmin());
        $fieldDescription->setAdmin($formMapper->getAdmin());
        $fieldDescription->setOption('edit', 'list');
        $fieldDescription->setAssociationMapping(array('fieldName' => 'formbuilder', 'type' => \Doctrine\ORM\Mapping\ClassMetadataInfo::MANY_TO_ONE));

         $builder = $formMapper->create('formbuilderId', 'sonata_type_model', array(
           'sonata_field_description' => $fieldDescription,
           'class'             => $this->getFormBuilderAdmin()->getClass(),
           'model_manager'     => $this->getFormBuilderAdmin()->getModelManager()
        ));

        
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                 array('title', 'text', array('required' => false)),
                 array($builder, null, array()),
            )
        ));
       
    }

    function validateBlock(ErrorElement $errorElement, BlockInterface $block) {

    }

     public function getFormBuilderAdmin()
    {
        if (!$this->formBuilderAdmin) {
            $this->formBuilderAdmin = $this->container->get('weare.formbuilder.admin.formbuilder');
        }

        return $this->formBuilderAdmin;
    }
     public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $formbuilder = $blockContext->getBlock()->getSetting('formbuiderId');

        return $this->renderResponse($blockContext->getTemplate(), array(
            'formbuilder'   => $formbuilder,
            'block'     => $blockContext->getBlock(),
            'settings'  => $blockContext->getSettings(),
            'elements'  => $formbuilder ? $this->buildElements($formbuilder) : array(),
        ), $response);
    }
    public function load(BlockInterface $block)
    {
        $formbuilder = $block->getSetting('formbuilderId');

        if ($formbuilder) {
            $formbuilder = $this->formbuilderManager->findOneBy(array('id' => $formbuilder));
        }

        $block->setSetting('formbuilderId', $formbuilder);
    }
     public function prePersist(BlockInterface $block)
    {
        $block->setSetting('formbuilderId', is_object($block->getSetting('formbuilderId')) ? $block->getSetting('formbuilderId')->getId() : null);
    }
    public function preUpdate(BlockInterface $block)
    {
        $block->setSetting('formbuilderId', is_object($block->getSetting('formbuilderId')) ? $block->getSetting('formbuilderId')->getId() : null);
    }
     private function buildElements(\Weare\FormBuilderBundle\Entity\FormBuilder $formbuilder)
    {
        $elements = array();
        foreach ($formbuilder->getFields() as $field) {
           

            $elements[] = array(
                'label'     => $field->getLabel(),
                'length'   => $field->getLength(),
                'nullable' => $field->getNullable(),
                'type'     => $field->getType(),
            );
        }

        return $elements;
    }

}
