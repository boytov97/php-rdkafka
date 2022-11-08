# - Run all containers
run_containers:
	docker-compose up
# - Connect to php container to run consumer or producer
connect_php_container:
	docker exec -it php-rdkafka bash
