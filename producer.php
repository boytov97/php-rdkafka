<?php

require_once 'vendor/autoload.php';

$conf = new RdKafka\Conf();
$conf->set('log_level', (string) LOG_DEBUG);
$conf->set('debug', 'all');

// Adding brokers
$rk = new RdKafka\Producer($conf);
$rk->addBrokers("localhost:9092");


$topic = $rk->newTopic("quickstart-events");

echo 'It is a producer' . PHP_EOL;