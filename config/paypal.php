<?php 
return [ 
    'client_id' => 'AafB64h3oMPvW1Gk5p-pJwDFJtGVEYsJ9eL19BfUDFqUugaZFQZQS_MU8BY1bdGq6E3t0LwmZOizbZiV',
	'secret' => 'EF9M9g7BlJwgJzzqBiCXtwqoV-2rEs9Y6MnTVslOiK0fARqdgobftEXj0v5ihZED-MgWecoIORfyHcj5',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];