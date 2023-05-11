<?php
return [
    'client_id' => 'AfmjY4alrGIOZiR9EnwpPmFRdx2SczcVA4CPsrInvOFsutPkIpJye47GStV24MvSrsh_uSIdmfWsSr7m',
	'secret' => 'ELhokVQ2hhzVUWRr4pThD9mCAh6T81vOI4UTL5Ta56P_W43miZokpwsMtC7wARZ5nqjoJlMNNX8wuqbG',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE',
    ),
    'settings_live' => array(
        'mode' => 'live',
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE',
    ),
];
