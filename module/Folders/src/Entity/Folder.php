<?php

namespace Folders\Entity;

use Application\Traits\Service\BuilderAwareTrait;
use Application\Traits\Entity\AuditableTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="folders")
 */
class Folder {
    
    use BuilderAwareTrait;
    
    use AuditableTrait;
 
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $folder_id;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $folder_number;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $folder_alias;
    
    /**
     * One Folder has many FieldValue.
     * @ORM\OneToMany(targetEntity="Folders\Entity\FieldValue", mappedBy="folder", cascade={"persist", "remove"})
     */
    protected $field_values;
    
    public function __construct() {
        $this->field_values = new ArrayCollection();
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
    }
}