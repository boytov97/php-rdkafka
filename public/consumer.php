<?php

$conf = new \RdKafka\Conf();
$conf->set('bootstrap.servers', 'kafka:9092');
$conf->set('enable.auto.commit', 'false');

$consumer = new \RdKafka\Consumer($conf);
$consumer->setLogLevel(LOG_DEBUG);
$consumer->addBrokers("kafka:9092");

$topic = $consumer->newTopic("php_rdkafka");

$partition = 0;

$topic->consumeStart($partition, RD_KAFKA_OFFSET_BEGINNING);

echo "consumer started" . PHP_EOL;

$tick = 0;

while (true) {
    $tick++;
    $msg = $topic->consume($partition, 1000);

    var_dump($tick);

    if ($msg->payload) {
        echo $msg->payload, "\n";

        $topic->offsetStore($partition, $msg->offset);
    }
}
