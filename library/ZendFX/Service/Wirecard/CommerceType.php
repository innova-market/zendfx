<?php
/**
 * ZendFX
 *
 * @category   ZendFX
 * @package    ZendFX_Service
 * @subpackage Wirecard
 * @copyright  Copyright (c) 2010 ZendFX (http://www.zendfx.com)
 * @author     Igor Golovanov <igor.golovanov@gmail.com>
 * @license    GNU General Public License v3 (http://www.gnu.org/licenses/gpl.html)
 * @version    1.0.0
 */

/**
 * Zend_Service_ReCaptcha
 *
 * @category   ZendFX
 * @package    ZendFX_Service
 * @subpackage Wirecard
 * @copyright  Copyright (c) 2010 ZendFX (http://www.zendfx.com)
 * @author     Igor Golovanov <igor.golovanov@gmail.com>
 * @license    GNU General Public License v3 (http://www.gnu.org/licenses/gpl.html)
 */
class ZendFX_Service_Wirecard_CommerceType
{
    /**
     * Options.
     * 
     * @var array
     */
    protected $_options = array(
        'file'      =>  'CommerceTypes.xml',
        'path'      =>  false,
    );

    /**
     * Types.
     *
     * @var array
     */
    protected $_types   =   array();

        /**
     * Constructor.
     * 
     * @param array $options Options.
     * @return void
     */
    public function __construct(array $options = array())
    {
        /**
         * Set options.
         */
        $this->_options = array_merge($this->_options, $options);

        /**
         * Load datafile.
         */
        $this->_loadDataFile();
    }

    /**
     * Load data file.
     *
     * @throws ZendFX_Service_Wirecard_Exception
     * @return void
     */
    protected function _loadDataFile()
    {
        /**
         * Form path to file.
         */
        if($this->_options['path'] !== false) {
            $path = trim($this->_options['path'], DIRECTORY_SEPARATOR);
        } else {
            $path = realpath(dirname(__FILE__))
                  . DIRECTORY_SEPARATOR
                  . 'Data';
        }

        /**
         * Form full path to datafile.
         */
        $file = $path . DIRECTORY_SEPARATOR . $this->_options['file'];

        /**
         * Verify that the datafile is exists.
         */
        if(!file_exists($file)) {
           /**
             * @see ZendFX_Service_Wirecard_Exception
             */
            require_once 'ZendFX/Service/Wirecard/Exception.php';
            throw new ZendFX_Service_Wirecard_Exception("CommerceType datafile '$file' not found!");
        }

        /**
         * Load datafile.
         */
        $xml = @simplexml_load_file($file);

        /**
         * Verify that the XML is correct.
         */
        if($xml === false) {
           /**
             * @see ZendFX_Service_Wirecard_Exception
             */
            require_once 'ZendFX/Service/Wirecard/Exception.php';
            throw new ZendFX_Service_Wirecard_Exception("CommerceType datafile '$file' is corrupted!");
        }

        /**
         * Parse XML data.
         */
        $data = (array)$xml;
        if(array_key_exists('Type', $data)) {
            $this->_types = array_merge($this->_types, $data['Type']);
        }
    }

    /**
     * Get list of types.
     * 
     * @return array
     */
    public function getTypeList()
    {
        return $this->_types;
    }

    /**
     * Validate commerce type.
     * 
     * @param string $type Commerce type.
     * @return bool
     */
    public function validate($type)
    {
        return (array_search($type, $this->_types) !== false)? true : false;
    }
}

