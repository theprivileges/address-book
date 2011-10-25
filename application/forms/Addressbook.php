<?php

/**
 * Address Book Application
 *
 * @author Luiz Lopes <luizlopes@gmail.com>
 * @package Address_Book
 */

/**
 * Address Book Entry Form
 *
 * @uses Zend_Form
 */
class Application_Form_Addressbook extends Zend_Form
{

    /**
     * Building up of the entry form
     */
    public function init()
    {
        //begin form
        $this->setName('address_form')
             ->setAttrib('id','address_form')
             ->setMethod('post');
        //id
        $this->addElement('hidden','id',array(
            'required' => false,
        ));

        //first name
        $this->addElement('text', 'firstname', array(
            'filters'    => array('StringTrim', 'Alnum'),
            'validators' => array(
                array('StringLength', false, array(0, 55)),
            ),
            'required'   => true,
            'label'      => 'First Name:',
            'autofocus'  => true,
            'placeholder' => 'Name',
            'title' => 'Please enter a first name',
            'maxlength' => 55,
        ));

        //last name
        $this->addElement('text', 'lastname', array(
            'filters'    => array('StringTrim', 'Alnum'),
            'validators' => array(
                array('StringLength', false, array(0, 55)),
            ),
            'required'   => true,
            'label'      => 'Last Name:',
            'placeholder' => 'Surname',
            'title' => 'Please enter a last name',
            'maxlength' => 55,
        ));
        
        //email
        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim','StringToLower'),
            'validators' => array(
                array('EmailAddress', false),
                array('Db_NoRecordExists', false, array('table' => 'addressbook',
                                                        'field' => 'email')),
            ),
            'required'   => true,
            'label'      => 'Email:',
            'placeholder' => 'name@domain.com',
            'title' => 'Please enter a valid email',
            'type'  => 'email',
        ));

        //phone number
        $this->addElement('text', 'phone', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(2,55)),
            ),
            'required' => false,
            'label' => 'Phone:',
            'title' => 'Please enter a contact phone number',
            'placeholder' => '407-555-1589',
            'maxlength' => 50,
        ));

        //address
        $this->addElement('text','address', array(
            'filters' => array('StringTrim'),
            'validators' => array (
                array('StringLength', false, array(0,150)),
            ),
            'required' => false,
            'title' => 'Please enter full address',
            'label' => 'Address:',
            'placeholder' => '123 Main St. City, State, Postal Code',
            'maxlength' => 150,
        ));
    }

    /**
     * Process entry form
     * 
     * @param array $post
     * @param Application_Model_Addressbook $entry
     * @return Application_Form_Addressbook 
     */
    public function process(array $post, Application_Model_Addressbook $entry)
    {
        // Are we editing an existing entry?
        if (null !== ($entry->getId())) {

            // Auto populate the form with existing info
            $this->populate($this->toArray($entry));

            // Make sure updated data is unique, but exlude existing entry
            $this->getElement('email')
                 ->addValidator('Db_NoRecordExists',
                                false,
                                array ('table' => 'addressbook',
                                       'field' => 'email',
                                       'exclude' => array (
                                            'field' => 'email',
                                            'value' => $entry->getEmail())));
        }
        // Okay, so we are going to process the data
        if (sizeof($post) && $this->isValid($post)) {
            // Setup entry object
            $entry = $this->assignEntryData($post,$entry);
            
            if ($entry->getMapper()->save($entry)) {
                return true;
            }
        }
        return $this;

    }

    /**
     * Create array version of Entry object
     *
     * @param Application_Model_Addressbook $entry
     * @return array $data
     */
    protected function toArray(Application_Model_Addressbook $entry)
    {
        $data = array();
        $data['id'] = $entry->id;
        $data['firstname'] = $entry->firstname;
        $data['lastname'] = $entry->lastname;
        $data['address'] = $entry->address;
        $data['phone'] = $entry->phone;
        $data['email'] = $entry->email;

        return $data;
    }

    /**
     * Create Addressbook object based on its' array form
     *
     * @param array $post
     * @param Application_Model_Addressbook $entry
     * @return Application_Model_Addressbook
     */
    protected function assignEntryData(array $post,
                                       Application_Model_Addressbook $entry)
    {
        $entry->setId($post['id'])
              ->setFirstname($post['firstname'])
              ->setLastname($post['lastname'])
              ->setEmail($post['email'])
              ->setPhone($post['phone'])
              ->setAddress($post['address']);

        return $entry;
    }


}

