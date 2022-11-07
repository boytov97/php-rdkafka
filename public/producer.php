<?php

$conf = new \RdKafka\Conf();
$conf->set('bootstrap.servers', 'kafka:9092');

$timeout_ms = 3000;
$producer = new \RdKafka\Producer($conf);
$producer->setLogLevel(LOG_DEBUG);

$addingResult = $producer->addBrokers("kafka:9092");

if ($addingResult < 1) {
    echo "Failed adding brokers\n";
    exit;
}

$topic = $producer->newTopic("php_rdkafka");

if (!$producer->getMetadata(false, $topic, 2000)) {
    echo "Failed to get metadata, is broker down?\n";
    exit;
}

$time = time();
$topic->produce(0, 0, "It is {$time}");

$producer->poll(1000);

$conf->setDrMsgCb(function (RdKafka\Kafka $kafka, RdKafka\Message $message) {
    echo "12";
    if ($message->err) {
        echo "failed";
        echo $message->errstr() . PHP_EOL;
    } else {
        echo "success";
    }
});

echo "Message published" . PHP_EOL;