<?php

namespace Forms\Entity;

use Application\Traits\Service\BuilderAwareTrait;
use Application\Traits\Entity\AuditableTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fields")
 */
class Field {
    
    use BuilderAwareTrait;
    
    use AuditableTrait;
 
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $field_id;
    
    /**
     * @ORM\Column(type="string", length = 255)
     */
    private $field_name;
    
    /**
     * @ORM\Column(type="string", length = 255)
     */
    private $field_key;
    
    /**
     * Many Fields have One Form.
     * @ORM\ManyToOne(targetEntity="Forms\Entity\Form", inversedBy="fields")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="form_id", onDelete="CASCADE")
     */
    protected $form;
    
}