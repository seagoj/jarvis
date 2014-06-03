<?php
require_once('IXR_Library.inc.php');

$params = "5055115338024";
$lookupMethod = 'lookupEAN';
$client = new IXR_Client('www.upcdatabase.com', '/rpc', 80);

if (!$client->query($lookupMethod, $params)) {
    die('Something went wrong - '.$client->getErrorCode().' : '.$client->getErrorMessage());
}

$array = $client->getResponse();

print $array['description'];

?>