<?php

namespace Folders\Entity;

use Application\Traits\Service\BuilderAwareTrait;
use Application\Traits\Entity\AuditableTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="field_values")
 */
class FieldValue {
    
    use BuilderAwareTrait;
    
    use AuditableTrait;
 
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $field_value_id;
    
    /**
     * @ORM\Column(type="text", length = 1000)
     */
    private $field_value;
    
    /**
     * One FieldValue has One Field.
     * @ORM\OneToOne(targetEntity="\Forms\Entity\Field")
     * @ORM\JoinColumn(name="field", referencedColumnName="field_id")
     */
    protected $field;
    
    /**
     * Many FieldValue have one Folder.
     * @ORM\ManyToOne(targetEntity="Folders\Entity\Folder", inversedBy="field_values")
     * @ORM\JoinColumn(name="folder", referencedColumnName="folder_id", onDelete="CASCADE")
     */
    protected $folder;
}