<?php

namespace Template\Entity;

use Application\Traits\Service\BuilderAwareTrait;
use Application\Traits\Entity\AuditableTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="templates")
 */
class Template {
    
    use BuilderAwareTrait;
    
    use AuditableTrait;
 
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $template_id;
    
    /**
	 * @ORM\Column(type="text")
	 */
    private $content;
    
}