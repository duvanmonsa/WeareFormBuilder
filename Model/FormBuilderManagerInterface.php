<?php



namespace Weare\FormBuilderBundle\Model;

interface FormBuilderManagerInterface
{
    
    public function create();
    
    public function delete(FormBuilderManagerInterface $formbuilder);

    public function findOneBy(array $criteria);

    public function findBy(array $criteria);

    public function getClass();

    public function update(FormBuilderManagerInterface $formbuilder);
}
