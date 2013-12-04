<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Weare\FormBuilderBundle\Entity;

use Weare\FormBuilderBundle\Model\FormBuilderManager as AbstractFormBuilderManager;
use Weare\FormBuilderBundle\Model\FormBuilderManagerInterface;
use Doctrine\ORM\EntityManager;

class FormBuilderManager extends AbstractFormBuilderManager
{
    protected $em;
    protected $repository;
    protected $class;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     * @param string                      $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em    = $em;
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    protected function getRepository()
    {
        if (!$this->repository) {
            $this->repository = $this->em->getRepository($this->class);
        }

        return $this->repository;
    }

    /**
     * {@inheritdoc}
     */
    public function update(FormBuilderManagerInterface $formbuilder)
    {
        $this->em->persist($formbuilder);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria)
    {
        return $this->getRepository()->findBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(FormBuilderManagerInterface $formbuilder)
    {
        $this->em->remove($formbuilder);
        $this->em->flush();
    }
}
