<?php

namespace WordEngine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $EntityManager;
    
    public function indexAction() {
        $request = $this->getRequest();
        
        if($request->isPost()) {
            
        }
        
        
        die('generating word document....');
        return new ViewModel();
    }
    
    public function setEntityManager($entityManager) {
        $this->EntityManager = $entityManager;
    }
    
    public function getEntityManager() {
        return $this->EntityManager;
    }
}
