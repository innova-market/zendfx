<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Error
 *
 * @author Игорёк
 */
class ZendFX_Service_Wirecard_Error
{
    /**
     * Directory name with errors file.
     * 
     * @var string
     */
    protected $_directory   = 'Error';

    protected $_filePrefix  = 'xml';

    protected $_fileDefault = 'en_EN';

    protected $_code = array();

    public function __construct($locale)
    {

        $xml = simplexml_load_file($this->_getPathToFile() . $this->_getFileName($locale));

        foreach($xml->children() as $v) {
            $this->_code[(int)$v->code]['description']   = (string)$v->description;
            $this->_code[(int)$v->code]['meaning']       = (string)$v->meaning;
            
        }
    }

    /**
     *
     * @param <type> $locale
     */
    protected function _getFileName($locale)
    {
        $filename = $locale . '.' . $this->_filePrefix;
        if(file_exists($this->_getPathToFile() . $filename)) {
           return $filename;
        }
        return $this->_fileDefault . '.' . $this->_filePrefix;
    }

    /**
     * Get path to file.
     *
     * @return string
     */
    protected function _getPathToFile()
    {
        $path = realpath(dirname(__FILE__))
              . DIRECTORY_SEPARATOR
              . $this->_directory
              . DIRECTORY_SEPARATOR;
        
        return $path;
    }


    protected function _parseFile()
    {
        
    }

    /**
     *
     * @param int $code Code.
     * @return string
     */
    public function getDescription($code)
    {
        return array_key_exists($code, $this->_code)? $this->_code[$code]['description'] : null;
    }

}

