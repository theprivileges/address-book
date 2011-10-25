<?php

/**
 * Address Book Application
 *
 * @author Luiz Lopes <luizlopes@gmail.com>
 * @package Address_Book
 */

/**
 * Addressbook Object
 *
 * Applicaiton_Model_Addressbook
 */
class Application_Model_Addressbook
{
    /**
     * this entry's id
     *
     * @var int
     */
    protected $_id;
    /**
     * this entry's first name
     *
     * @var string
     */
    protected $_firstname;
    /**
     * this entry's last name
     *
     * @var string
     */
    protected $_lastname;
    /**
     * this entry's email address
     *
     * @var string
     */
    protected $_email;
    /**
     * this entry's address
     *
     * @var string
     */
    protected $_address;
    /**
     * this entry's phone number
     *
     * @var string
     */
    protected $_phone;

    /**
     * this object's data mapper
     * 
     * @var Application_Model_AddressbookMapper
     */
    protected $_mapper;

    /**
     * Object's Constructor
     * 
     * @param array $options
     */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }

    }

    /**
     * Object's setter
     * 
     * @param string $name
     * @param string $value
     * @return Application_Model_Addressbook
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this,$method)) {
            throw new Zend_Exception('Trying to set a property that doesn\'t exist');
        }
        return $this->$method($value);
    }

    /**
     * Object's getter
     * 
     * @param string $name
     * @return Application_Model_Addressbook
     */
    public function __get($name)
    {        
        $method = 'get' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this,$method)) {
            throw new Zend_Exception('Trying to get a property that doesn\'t exist');
        }
        return $this->$method();

    }

    /**
     * Set up this Object, given an array of options
     *
     * @param array $options
     * @return Application_Model_Addressbook
     */
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            } else {
                throw new Zend_Exception('Call to invalid method');
            }
        }
        return $this;

    }

    /**
     * Set up this object's Data Mapper
     *
     * @param string $mapper
     * @return Application_Model_Addressbook
     */
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }

    /**
     * return this object's Data Mapper
     *
     * @return Application_Model_AddressbookMapper
     */
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Application_Model_AddressbookMapper());
        }
        return $this->_mapper;
    }

    /**
     * assign this entry's id
     *
     * @param int $id
     * @return Application_Model_Addressbook
     */
    public function setId($id = 0)
    {
        $this->_id = (int) $id;
        return $this;
    }

    /**
     * return this entry's id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * assing this entry's first name
     *
     * @param string $firstname
     * @return Application_Model_Addressbook
     */
    public function setFirstname($firstname)
    {
        $this->_firstname = (string) $firstname;
        return $this;
    }

    /**
     * return this entry's first name
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->_firstname;
    }

    /**
     * assign this entry's last name
     *
     * @param string $lastname
     * @return Application_Model_Addressbook 
     */
    public function setLastname($lastname)
    {
        $this->_lastname = (string) $lastname;
        return $this;
    }

    /**
     * get this entry's last name
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->_lastname;
    }

    /**
     * assign this entry's email address
     *
     * @param string $email
     * @return Application_Model_Addressbook
     */
    public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }

    /**
     * return this entry's email address
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * assign this entry's address
     *
     * @param string $address
     * @return Application_Model_Addressbook
     */
    public function setAddress($address)
    {
        $this->_address = (string) $address;
        return $this;
    }

    /**
     * return this entry's address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * assign a phone number to this entry
     *
     * @param string $phone
     * @return Application_Model_Addressbook
     */
    public function setPhone($phone)
    {
        $this->_phone = (string) $phone;
        return $this;
    }

    /**
     * return this entry's phone number
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

}

