<?php

$conf = new \RdKafka\Conf();
$conf->set('bootstrap.servers', 'kafka:9092');
$conf->set('group.id', 'my_consumer_group');

$consumer = new \RdKafka\Consumer($conf);
$consumer->setLogLevel(LOG_DEBUG);
$consumer->addBrokers("kafka:9092");

$topic = $consumer->newTopic("php_rdkafka");

$partition = 0;

/*
 * RD_KAFKA_OFFSET_STORED
 *
 * RD_KAFKA_OFFSET_BEGINNING
 */
$topic->consumeStart($partition, RD_KAFKA_OFFSET_STORED);

echo "consumer started" . PHP_EOL;

$tick = 0;

while (true) {
    $tick++;
    $msg = $topic->consume($partition, 1000);

    echo "tick: {$tick}" . PHP_EOL;

    if ($msg->payload) {
        echo $msg->payload . PHP_EOL;
    }
}
