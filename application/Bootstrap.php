<?php
/**
 * Address Book Application
 *
 * @author Luiz Lopes <luizlopes@gmail.com>
 * @package Address_Book
 */

/**
 * Application Bootstrap
 *
 * @uses Zend_Application_Bootstrap_Bootstrap
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     *
     * @param string $application
     */
    public function __construct($application)
    {
        // Load configuration
        Zend_Registry::set('configSection', $application);
        $config = $application->getOptions();
        Zend_Registry::set('config', $config);

        parent::__construct($application);
    }


}

