<?php
/**
 *
 * 
 */

/**
 * @see ZendFX_Service_Wirecard
 */
require_once 'ZendFX/Service/Wirecard.php';

/**
 * @see ZendFX_Service_Wirecard_Request
 */
require_once 'ZendFX/Service/Wirecard/Request.php';

/**
 *
 * 
 */
abstract class ZendFX_Service_Wirecard_Transaction_Abstract
{
    /**
     * Options.
     * 
     * @var array
     */
    protected $_options;

    /**
     * Collection name.
     * 
     * @var string
     */
    protected $_collectionName;

    /**
     * Job ID.
     * 
     * @var string
     */
    protected $_jobId;

    /**
     * Request.
     * 
     * @var ZendFX_Service_Wirecard_Request
     */
    protected $_request;

    /**
     * Constructor.
     * 
     * @param array $options Options.
     * @return void
     */
    public function __construct(array $options = array())
    {
        $this->_options = $options;
        $this->_request = new ZendFX_Service_Wirecard_Request();
    }

    /**
     * Get collection name.
     *
     * @return string
     */
    public function getCollectionName()
    {
        return $this->_collectionName;
    }

    /**
     * Get request.
     *
     * @return ZendFX_Service_Wirecard_Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * Set Request.
     * 
     * @param ZendFX_Service_Wirecard_Request $request Request.
     * @return ZendFX_Service_Wirecard_Transaction_Abstract 
     */
    public function setRequest(ZendFX_Service_Wirecard_Request $request)
    {
        $this->_request = $request;  
        return $this;
    }




    /**
     * @return ZendFX_Service_Wirecard_Response
     */
    public function getResponse()
    {
        
    }

    public function temp()
    {
        print_r($this->_options);
    }
}

