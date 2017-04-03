<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Folders\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Folders\Entity\Folder;
use Folders\Entity\FieldValue;


class IndexController extends AbstractActionController
{
    protected $EntityManager;

    public function indexAction() {
        $request = $this->getRequest();
        
        if($request->isPost()) {
            
        }
        
        return new ViewModel();
    }
    
    /**
     * Endpoint for creating new folder
     */
    public function newAction() {
        //we need to fetch the default selected form.
        $request = $this->getRequest();
        
        $defaultForm = $this->getEntityManager()->getRepository(\Forms\Entity\Form::class)->findBy(['is_form_default' => 1]);
        if(!isset($defaultForm[0]) || empty($defaultForm[0])) {
            throw new \Doctrine\ORM\EntityNotFoundException('Default form couln\'t be found in database. Please insert a default form first.');
        }
        
        if($request->isPost()) {
            $post = $request->getPost();
            //aplicare validare aici :)
            
            $folder = new Folder();
            $folder->setFolderNumber($post['folder_number']);
            foreach($post['field_values'] as $field_id => $field_value_input):
                //the most optim way would be to math the form fileds to these ids.
                $field = $this->getFieldFromFormById($defaultForm[0], $field_id);
                if(!$field) {
                    throw new \Doctrine\ORM\EntityNotFoundException('Couln\'t math field with id ['.$field_id.'] to any of the default form fields.');
                }
                $field_value = new FieldValue();
                $field_value->setFolder($folder);
                $field_value->setFieldValue($field_value_input);
                $field_value->setField($field);
                //echo "<pre>";var_dump($field_value->getCreated());die;
            
                $this->getEntityManager()->persist($field_value);
            endforeach;
            
            $this->getEntityManager()->persist($folder);
            $this->getEntityManager()->flush();
            return $this->redirect()->toRoute('folders_route', ['action' => 'edit', 'id' => $folder->getFolderId()]);
        }
        
        //Query database for all forms.
        $allForms = $this->getEntityManager()->getRepository(\Forms\Entity\Form::class)->findAll();
        
        return [
            'forms' => $allForms,
            'default_form' => $defaultForm[0]
        ];
    }
    
    /**
     * Endpoint for editing folder
     */
    public function editAction() {
        
    }
    
    public function setEntityManager($entityManager) {
        $this->EntityManager = $entityManager;
    }
    
    public function getEntityManager() {
        return $this->EntityManager;
    }
    
    private function getFieldFromFormById(\Forms\Entity\Form $form, $field_id) {
        foreach($form->getFields() as $field) :
            if($field->getFieldId() == $field_id) {
                return $field;
            }
        endforeach;
        
        return null;
    }
}
