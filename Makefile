build_image\#php-rdkafka:
	docker build -t php/rdkafka:v1 .

run_container\#php-rdkafka:
	docker run -it --rm -v "${CURDIR}":/app --name php-rdkafka php/rdkafka:v1 bash

run_kafka_server:
	docker-compose up		