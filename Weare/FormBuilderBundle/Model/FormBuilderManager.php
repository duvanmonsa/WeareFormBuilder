<?php


namespace Weare\FormBuilderBundle\Model;

abstract class FormBuilderManager implements FormBuilderManagerInterface
{
    /**
     * Creates an empty FormBuilder instance
     *
     * @return FormBuilder
     */
    public function create()
    {
        $class = $this->getClass();

        return new $class;
    }
}
