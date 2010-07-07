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


    

    public function __construct(array $options = array())
    {
        
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

    /**
     *
     * @param <type> $transaction
     * @param array $options
     * @return ZendFX_Service_Wirecard_Transaction_Abstract
     */
    public function transaction($transaction, array $options = array())
    {
        
    }


    public function __call($method, $args)
    {
        $method = mb_ereg_replace('transaction', '', $method);

        $class  = __CLASS__ . '_' . 'Transaction' . '_' . $method;
        require_once mb_ereg_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        if(!class_exists($class)) {
            require_once 'ZendFX/Service/Wirecard/Exception/TransactionNotFound.php';
            throw new ZendFX_Service_Wirecard_Exception_TransactionNotFound('Transaction ' . $method . 'not found!');
        }
        return new $class();
    }
}

