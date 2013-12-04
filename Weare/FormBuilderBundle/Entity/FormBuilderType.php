<?php 

namespace Weare\FormBuilderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="formbuilder__type")
 */
class FormBuilderType
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name = null;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $class = null;
	
  
    public function __toString()
    {
        return $this->name.'';
    }
    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set class
     *
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * Get class
     *
     * @return string $class
     */
    public function getClass()
    {
        return $this->class;
    }
}