<?php

namespace Forms\Entity;

use Application\Traits\Service\BuilderAwareTrait;
use Application\Traits\Entity\AuditableTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="forms")
 */
class Form {
    
    use BuilderAwareTrait;
    
    use AuditableTrait;
 
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $form_id;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $is_form_default = 0;
    
    /**
     * @ORM\Column(type="string", length = 255)
     */
    private $form_name = "Default Form";
    
    /**
     * One Form has Many Fields.
     * @ORM\OneToMany(targetEntity="Forms\Entity\Field", mappedBy="form", cascade={"persist", "remove"})
     */
    protected $fields;
    
    public function __construct() {
        $this->fields = new ArrayCollection();
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
    }
    
    public function getFields() {
        return $this->fields;
    }
    
    public function setFields($fields) {
        $this->fields = $fields;
    }
}