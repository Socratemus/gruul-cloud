<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Template\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Template\Entity\Template;

class IndexController extends AbstractActionController
{
    protected $EntityManager;
    
    public function indexAction() {
        $request = $this->getRequest();
        
        if($request->isPost()) {
            $data = $request->getPost(); 
            $template = new Template();
            $template->setContent($data['template-editor']);
            
            $this->getEntityManager()->persist($template);
            $this->getEntityManager()->flush();
            
            //var_dump($template);
            exit('posting...');
        }
        
        
        return new ViewModel();
    }
    
    public function resetAction() {
        $em = $this->getEntityManager(); 
			
		$meta = array(
			$em->getClassMetadata('Template\Entity\Template'),
			
			$em->getClassMetadata('Forms\Entity\Form'),	
			$em->getClassMetadata('Forms\Entity\Field'),	
			
        );
		$tool = new \Doctrine\ORM\Tools\SchemaTool($em);
		$tool->updateSchema($meta);   
		die('update schema done');
    }   
    
    
    
    public function setEntityManager($entityManager) {
        $this->EntityManager = $entityManager;
    }
    
    public function getEntityManager() {
        return $this->EntityManager;
    }
}
