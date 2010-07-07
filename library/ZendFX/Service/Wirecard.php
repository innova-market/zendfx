<?php
/**
 *
 * @author Igor Golovanov <igor.golovanov@gmail.com>
 */

/**
 *
 *
 * @author Igor Golovanov <igor.golovanov@gmail.com>
 * @copyright 2010 (c) ZendFX (http://zendfx.googlecode.com/)
 */
class ZendFX_Service_Wirecard
{
    const TRANSACTION_MODE              =   'mode';
    const TRANSACTION_MODE_DEMO         =   'demo';
    const TRANSACTION_MODE_LIVE         =   'live';

    /**
     * Options.
     * 
     * @var array
     */
    protected $_options;



    /**
     * Constructor.
     * 
     * @param array $options Options.
     * @return void
     */
    public function __construct(array $options = array())
    {
        $this->_options = $options;
    }

    /**
     * Transaction.
     * 
     * @param string $transactionName Transaction name.
     * @param array $options Options.
     * @throws ZendFX_Service_Wirecard_Exception
     * @return ZendFX_Service_Wirecard_Transaction_Abstract
     */
    public function transaction($transactionName, array $options = array())
    {
        /*
         * Verify that an transaction name has been specified.
         */
        if (!is_string($transactionName) || empty($transactionName)) {
            /**
             * @see ZendFX_Service_Wirecard_Exception
             */
            require_once 'ZendFX/Service/Wirecard/Exception.php';
            throw new ZendFX_Service_Wirecard_Exception('Transaction name must be specified in a string');
        }

        /*
         * Form full transaction class name.
         */
        $class  = __CLASS__ . '_' . 'Transaction' . '_';
        $class .= str_replace(' ', '_', ucwords(str_replace('_', ' ', strtolower($transactionName))));

        /*
         * Load the transaction class.  This throws an exception
         * if the specified class cannot be loaded.
         */
        if (!class_exists($class)) {
            require_once 'Zend/Loader.php';
            Zend_Loader::loadClass($class);
        }

        /*
         * Create an instance of the transaction class.
         * Pass the config to the transaction class constructor.
         */
        $transaction = new $class(array_merge($this->_options, $options));
        
        /*
         * Verify that the object created is a descendent of the abstract transaction.
         */
        if (! $transaction instanceof ZendFX_Service_Wirecard_Transaction_Abstract) {
            /**
             * @see ZendFX_Service_Wirecard_Exception
             */
            require_once 'ZendFX/Service/Wirecard/Exception.php';
            throw new ZendFX_Service_Wirecard_Exception("Transaction class '$transaction' does not extend ZendFX_Service_Wirecard_Transaction_Abstract");
        }

        return $transaction;
    }

    /**
     * Filter for transaction mode.
     *
     * @param string $mode Transaction mode.
     * @return string
     */
    public static function filterTransactionMode($mode)
    {
        switch ($mode) {
            case self::TRANSACTION_MODE_DEMO:
                return self::TRANSACTION_MODE_DEMO;

            case self::TRANSACTION_MODE_LIVE:
            default:
                return self::TRANSACTION_MODE_LIVE;
        }
    }
}

