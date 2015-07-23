<?php

use Monolog\Logger;

return array(
    'hosts' => array(
        '127.0.0.1:9200'
    ),
    'logPath' => '/var/log/elasticsearch',
    'logLevel' => Logger::INFO
);
