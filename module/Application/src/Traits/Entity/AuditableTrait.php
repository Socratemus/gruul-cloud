<?php

namespace Application\Traits\Entity;

trait AuditableTrait {

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $created;
			
	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $updated;
		
			
	/**
     * #@ORM\OneToOne(targetEntity="Application\Entity\User")
     * #@ORM\JoinColumn(name="created_by", referencedColumnName="user_id", nullable=true)
     */
	protected $created_by  = null;
	
	/**
     * #@ORM\OneToOne(targetEntity="Application\Entity\User")
     * #@ORM\JoinColumn(name="updated_by", referencedColumnName="user_id", nullable=true)
     */
	protected $update_by = null;
	
	function __construct() {
    	$this->created = new \DateTime('now');	
    	$this->updated = new \DateTime('now');
	}
}