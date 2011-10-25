<?php

/**
 * Address Book Application
 * 
 * @author Luiz Lopes <luizlopes@gmail.com>
 * @package Address_Book
 * 
 */

/**
 * Index Controller
 * 
 * @uses Zend_Controller_Action
 */
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    /**
     * List all available entries
     */
    public function indexAction()
    {
        $this->view->assign('title', 'Addresses');
        $mapper = new Application_Model_AddressbookMapper();
        $this->view->entry = $mapper->fetchAll();
        
    }

    /**
     * Add an new address to the application
     */
    public function addAction()
    {
        $this->view->formResponse = '';        
        $this->view->assign('title', 'Add New Address');
        $mapper = new Application_Model_AddressbookMapper();
        $form = $mapper->getAddEntryForm($this->getRequest()->getPost());
        // Did the form get submitted?
        if ($form === true) {
            $this->view->formResponse = 'New Address Saved!';
            $this->_forward('index');
        }
        $this->view->form = $form;
    }

    /**
     * Edit an existing address
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id',null);
        $this->view->formResponse = '';
        $this->view->assign('title', 'Edit Address');
        $mapper = new Application_Model_AddressbookMapper();
        $form = $mapper->getEditEntryForm($this->getRequest()->getPost(),$id);
        // Did the form get submitted?
        if ($form === true) {
            $this->view->formResponse = 'Address Updated!';
            $this->_forward('index');
        }
        $this->view->form = $form;
    }

    /**
     * Delete an existing address
     */
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $mapper = new Application_Model_AddressbookMapper();

        if ($mapper->delete($id)) {
            $this->view->formResponse = 'Address Deleted';
        } else {
            $this->view->formResponse = 'Failed to delete address';
            $this->_redirect(array('controller' => 'index', 'action' => 'view',
                                   'id' => $id));
        }
        
        $this->_forward('index');
    }

    /**
     * View the details of an address
     */
    public function viewAction()
    {
        $this->view->assign('title','View Address');
        $id = $this->getRequest()->getParam('id',null);
        $mapper = new Application_Model_AddressbookMapper();
        $this->view->entry = $mapper->findEntry($id);
    }


}









