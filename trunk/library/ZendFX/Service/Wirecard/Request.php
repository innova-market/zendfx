<?php

/**
 * @see ZendFX_Service_Wirecard
 */
require_once 'ZendFX/Service/Wirecard.php';



class ZendFX_Service_Wirecard_Request
{
    /**
     * Options.
     * 
     * @var array
     */
    protected $_options;

    


    public function __construct(array $options = array())
    {
        $this->_options = $this->_filterOptions($options);
    }

    /**
     * Filter options.
     * 
     * @return array
     */
    protected function _filterOptions(array $options)
    {
        $options['mode'] = ZendFX_Service_Wirecard::filterTransactionMode(@$options['mode']);

        return $options;
    }

    /**
     * Set transaction mode.
     *
     * @param string $mode
     * @return ZendFX_Service_Wirecard_Transaction_Abstract
     */
    public function setMode($mode)
    {
        $this->_options['mode'] = ZendFX_Service_Wirecard::filterTransactionMode($mode);

        return $this;
    }

    /**
     * Get XML Request.
     * 
     * @return string
     */
    final public function getXmlRequest()
    {
        return '';
    }
}

