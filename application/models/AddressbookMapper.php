<?php

/**
 * Address Book Application
 *
 * @author Luiz Lopes <luizlopes@gmail.com>
 * @package Address_Book
 */

/**
 * Addressbook Data Mapper
 *
 * Connects the data in the model with the data source in the table
 */
class Application_Model_AddressbookMapper
{
    /**
     * Database table associated to this object
     * 
     * @var Application_Model_DbTable_Addressbook
     */
    protected $_dbTable;

    /**
     *
     * @param string $dbTable
     * @throws Zend_Exception
     * @return Application_Model_AddressbookMapper
     */
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable ();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Zend_Exception('Invalid table database gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    /**
     *
     * @return Application_Model_DbTable_Addressbook
     */
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Addressbook');
        }
        return $this->_dbTable;
    }

    /**
     * Save new entry to table
     * 
     * @param Application_Model_Addressbook $entry
     * @return mixed
     */
    public function save(Application_Model_Addressbook $entry)
    {
        $data = array (
            'id' => $entry->id,
            'firstname' => $entry->firstname,
            'lastname' => $entry->lastname,
            'email' => $entry->email,
            'address' => $entry->address,
            'phone' => $entry->phone,
        );
        
        if (0 === ($id = $entry->getId())) {
            unset($data['id']);
            try {
                $this->getDbTable()->insert($data);
            } catch (Zend_Exception $e) {
                Zend_Debug::dump($e->getMessage(),'<PRE>');
                return false;
            }
        } else {
            try {
                $this->getDbTable()->update($data,array('id = ?' => $id));
            } catch (Zend_Exception $e) {
                Zend_Debug::dump($e->getMessage(),'<PRE>');
                return false;
            }
        }
        return true;

    }

    /**
     * Delete an entry based on the given entry's id
     * 
     * @param int $id
     * @return bool 
     */
    public function delete($id){
        if ($this->getDbTable()->delete(array('id = ?' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Return all available entries
     * 
     * @return Application_Model_Addressbook 
     */
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Addressbook();
            // build entry object
            $entry->setId($row->id)
                  ->setAddress($row->address)
                  ->setEmail($row->email)
                  ->setPhone($row->phone)
                  ->setFirstname($row->firstname)
                  ->setLastname($row->lastname);
            $entries[] = $entry;
        }
        
        return $entries;
        
    }

    /**
     * Find a single entry in the table, and build entry object.
     * 
     * @param int $id
     * @return Application_Model_Addressbook 
     */
    public function findEntry($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current()->toArray();
        $entry = new Application_Model_Addressbook($row);

        return $entry;
        
    }

    /**
     * Display and process new entry form
     * 
     * @param array $post
     * @return bool|Application_Form_Addressbook
     */
    public function getAddEntryForm(array $post)
    {
        $form = new Application_Form_Addressbook();
        $entry = new Application_Model_Addressbook();

        return $form->process($post, $entry);

    }

    /**
     * Display and process edit existing entry form
     * 
     * @param array $post
     * @param int $id
     * @return bool|Application_Form_Addressbook
     */
    public function getEditEntryForm(array $post, $id)
    {
        $form = new Application_Form_Addressbook();
        $entry = $this->findEntry($id);

        return $form->process($post, $entry);
        
        
    }


}

