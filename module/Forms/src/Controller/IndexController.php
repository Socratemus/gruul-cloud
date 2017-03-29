<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Forms\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Forms\Entity\Form;
use Forms\Entity\Field;


class IndexController extends AbstractActionController
{
    protected $EntityManager;
    
    public function indexAction() {
        $request = $this->getRequest();
        
        if($request->isPost()) {
            $form = new Form();
            
            $data = $request->getPost(); 
            
            foreach($data['field_name'] as $index => $object) {
                $field = new Field();
                $field->setFieldName($object);
                $field->setFieldKey($data['field_key'][$index]);
                $field->setForm($form);
                $form->getFields()->add($field);
                $this->getEntityManager()->persist($field);
            }
            
            $this->getEntityManager()->persist($form);
            $this->getEntityManager()->flush();
            var_dump($data);
            exit('');
        }
        
        return new ViewModel();
    }
    
    public function setEntityManager($entityManager) {
        $this->EntityManager = $entityManager;
    }
    
    public function getEntityManager() {
        return $this->EntityManager;
    }
}
