<?php

class ZendFX_Service_Wirecard_AddressVerificationService
{
    /**
     * AVS Codes filename.
     * 
     * @var string
     */
    protected $_fileAVSCodes        =   'Codes';

    /**
     * AVS Messages filename.
     *
     * @var string
     */
    protected $_fileAVSMessage      =   'Messages';

    /**
     * Directory data.
     *
     * @var string
     */
    protected $_directoryData       =   'Data/AddressVerificationService';


    
    public function __construct(array $options = array())
    {

    }


    /**
     * Get full path to file with Address Verification Service Codes.
     * 
     * @throws ZendFX_Service_Wirecard_Exception_AddressVerificationService_DataFileNotFound
     * @return string
     */
    protected function _getPathFileAVSCodes()
    {
        $path = realpath(dirname(__FILE__))
              . DIRECTORY_SEPARATOR
              . trim($this->_directoryData, '/')
              . DIRECTORY_SEPARATOR
              . $this->_fileAVSCodes
              . '.xml';

        if(!file_exists($path)) {
            throw new ZendFX_Service_Wirecard_Exception_AddressVerificationService_DataFileNotFound($path);
        }

        return $path;
    }

    
    protected function _getPathFileAVSMessages($locale)
    {

    }
}

