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
     * One Form has Many Fields.
     * @ORM\OneToMany(targetEntity="Forms\Entity\Field", mappedBy="Form", cascade={"persist", "remove"})
     */
    protected $fields;
    
    public function __construct() {
        $this->fields = new ArrayCollection();
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
    }
}