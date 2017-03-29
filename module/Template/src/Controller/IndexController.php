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
    
    const TEMPLATE_REPO = "Template\Entity\Template";


    public function indexAction() {
        $request = $this->getRequest();
        
        if($request->isPost()) {
            $data = $request->getPost(); 
            $template = new Template();
            
            $template->setTemplateName($data['template_name']);
            $template->setContent($data['template-editor']);
            
            $this->getEntityManager()->persist($template);
            $this->getEntityManager()->flush();
            
            return $this->redirect()->toRoute('template', ['action' => 'edit', 'id' => $template->getTemplateId()]);
        }
        
        
        return new ViewModel(['template' => new Template(), 'action' => 'NEW']);
    }
    
    public function editAction() {
        $request = $this->getRequest();
        $template_id = $this->params()->fromRoute('id');
        
        $form_id = 1; //Hard coded value
        
        $form = $this->getEntityManager()->getRepository('Forms\Entity\Form')->findBy([
            'form_id' => $form_id
        ]);
        
        if(!isset($form[0]) || empty($form[0])) {
            throw new \Doctrine\ORM\EntityNotFoundException("Form" . ' with ID: [ ' . $template_id . ' ] was not found.');
        }
        
        $form = $form[0];
        
        $template = $this->getEntityManager()->getRepository(self::TEMPLATE_REPO)->findBy(['template_id'=>$template_id]);
        
        if(!isset($template[0]) || empty($template[0])) {
            throw new \Doctrine\ORM\EntityNotFoundException(self::TEMPLATE_REPO . ' with ID: [ ' . $template_id . ' ] was not found.');
        }
        
        $template = $template[0];
        
        if($request->isPost()) {
            $data = $request->getPost(); 
            $template->setTemplateName($data['template_name']);
            $template->setContent($data['template-editor']);
            $this->getEntityManager()->persist($template);
            $this->getEntityManager()->flush();
            
            return $this->redirect()->toRoute('template', ['action' => 'edit', 'id' => $template->getTemplateId()]);
        }
        
        $view = new ViewModel(['template' => $template, 'action' => 'EDIT', 'form' => $form]);
        $view->setTemplate('template/index/index');
        return $view;
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
        exit('update schema done');
    }   
    
    public function setEntityManager($entityManager) {
        $this->EntityManager = $entityManager;
    }
    
    public function getEntityManager() {
        return $this->EntityManager;
    }
}
