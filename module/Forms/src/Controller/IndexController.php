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
    
    public function newAction() {
        $request = $this->getRequest();
        $form = new Form();
        if($request->isPost()) {
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
            return $this->redirect()->toRoute('forms_route', ['action' => 'edit', 'id' =>$form->getFormId()]);
         }
        return [
            'form' => $form,
            'action' => 'new'
        ];
    }
    
    public function editAction() {
        $request = $this->getRequest();
        $form_id = $this->params()->fromRoute('id');
        $form = $this->getEntityManager()->getRepository(\Forms\Entity\Form::class)->findBy(['form_id' => $form_id]);
        if(!$form[0]) {
            throw new \Doctrine\ORM\EntityNotFoundException("Form" . ' with ID: [ ' . $form_id . ' ] was not found.');
        }
        
        if($request->isPost()) {
            $data = $request->getPost();
            
            $form[0]->setFormName($data['form_name']);
            $form[0]->setIsFormDefault($data['is_form_default']);
            
            foreach($form[0]->getFields() as $field) {
                $form[0]->getFields()->remove($field);
                $this->getEntityManager()->remove($field);
                
            }
            //$this->getEntityManager()->persist($form[0]);
            $this->getEntityManager()->flush();
            //return $this->redirect()->toRoute('forms_route', ['action' => 'edit', 'id' =>$form[0]->getFormId()]);
            foreach($data['field_name'] as $index => $object) {
                $field = new Field();
                $field->setFieldName($object);
                $field->setFieldKey($data['field_key'][$index]);
                $field->setForm($form[0]);
                if(isset($data['field_id'][$index]) && !empty($data['field_id'][$index])) {
                    $field->setFieldId($data['field_id'][$index]);    
                }
                $form[0]->getFields()->add($field);
                $this->getEntityManager()->persist($field);
            }
            //var_dump( $form[0]->getFields()[0]);
            $this->getEntityManager()->persist($form[0]);
            $this->getEntityManager()->flush();
            return $this->redirect()->toRoute('forms_route', ['action' => 'edit', 'id' =>$form[0]->getFormId()]);
         }
        
        $view = new ViewModel(['form' => $form[0], 'action' => 'edit']);
        $view->setTemplate('forms/index/new');
        return $view;
    }
    
    public function setEntityManager($entityManager) {
        $this->EntityManager = $entityManager;
    }
    
    public function getEntityManager() {
        return $this->EntityManager;
    }
}
