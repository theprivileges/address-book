<?php

/**
 * Address Book Application
 *
 * @author Luiz Lopes <luizlopes@gmail.com>
 * @package Address_Book
 */

/**
 * Addressbook table Object
 * 
 * @uses Zend_Db_Table_Abstract
 */
class Application_Model_DbTable_Addressbook extends Zend_Db_Table_Abstract
{

    /**
     * name of database table
     * 
     * @access protected
     * @var string
     */
    protected $_name = 'addressbook';


}

