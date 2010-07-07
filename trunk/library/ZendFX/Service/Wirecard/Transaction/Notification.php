<?php

/**
 * @see ZendFX_Service_Wirecard_Transaction_Abstract
 */
require_once 'ZendFX/Service/Wirecard/Transaction/Abstract.php';

class ZendFX_Service_Wirecard_Transaction_Notification extends ZendFX_Service_Wirecard_Transaction_Abstract
{
    /**
     * Collection name.
     *
     * @var string
     */
    protected $_collectionName      =   'FNC_CC_NOTIFICATION';
}
