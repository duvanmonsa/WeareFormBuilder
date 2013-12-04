<?php 

namespace Weare\FormBuilderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="formbuilder__field")
 */
class FormBuilderField
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id = null;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $label = null;
    /**
     * @ORM\Column(type="integer", length=4,nullable = true)
     */
    private $length = null;
    /**
     * @ORM\Column(type="boolean")
     */
    private $nullable = false;
    
     /**
        * @ORM\ManyToOne(targetEntity="Weare\FormBuilderBundle\Entity\FormBuilder", inversedBy="form_builder", cascade={"persist"})
        * @ORM\JoinColumn(name="form_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $form;
	
    /**
     * @ORM\ManyToOne(targetEntity="FormBuilderType")
     */
    private $type = null;


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
     * Set label
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return string $label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set type
     *
     * @param Weare\FormBuilderBundle\Entity\FormBuilderType $type
     */
    public function setType(\Weare\FormBuilderBundle\Entity\FormBuilderType $type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return Weare\FormBuilderBundle\Entity\FormBuilderType $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set form
     *
     * @param \Weare\FormBuilderBundle\Entity\FormBuilder $form
     * @return FormBuilderField
     */
    public function setForm(\Weare\FormBuilderBundle\Entity\FormBuilder $form = null)
    {
        $this->form = $form;
    
        return $this;
    }

    /**
     * Get form
     *
     * @return \Weare\FormBuilderBundle\Entity\FormBuilder 
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Set length
     *
     * @param integer $length
     * @return FormBuilderField
     */
    public function setLength($length)
    {
        $this->length = $length;
    
        return $this;
    }

    /**
     * Get length
     *
     * @return integer 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set nullable
     *
     * @param boolean $nullable
     * @return FormBuilderField
     */
    public function setNullable($nullable)
    {
        $this->nullable = $nullable;
    
        return $this;
    }

    /**
     * Get nullable
     *
     * @return boolean 
     */
    public function getNullable()
    {
        return $this->nullable;
    }
}