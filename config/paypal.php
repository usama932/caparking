<?php 
return [ 
    'client_id' => 'AQDo_4Msx6bwCWesP5Pb2bgb7LIaeFnprdpowlFt7gvfdoFP3ILaKLYJb5Ssq7xKxopoIf2eEWA7iOw-',
	'secret' => 'EJrvtcJ5Zd5EfVno5A7i2rkAcAQld9ALwXAKeOzvMrb0BK5AimVK0WjOkV-ITk7Nt6Xs7675hyNuMxS6',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];