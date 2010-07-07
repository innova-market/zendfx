<?php

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(realpath(dirname(__FILE__)) . '/../library'),
    get_include_path(),
)));

require_once 'ZendFX/Service/Wirecard.php';
require_once 'ZendFX/Service/Wirecard/Request.php';
require_once 'ZendFX/Service/Wirecard/CommerceType.php';

try {
    $ct = new ZendFX_Service_Wirecard_CommerceType();
  //  print_r($ct->validateType('MOTO'));
} catch (Exception $exc) {
    echo $exc->getMessage();
}




$wirecard = new ZendFX_Service_Wirecard(array('host' => 'hehe'));

$auth = $wirecard->transaction('Authorization', array('host' => '2'));
$auth->temp();
//$auth->setRequest(new ZendFX_Service_Wirecard_Request());

