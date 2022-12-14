# Php-rdkafka

Пример docker окружения, где мы можем на php писать и читать сообщение из kafka. Самые простые примеры producer-а и 
consumer-а помогает понять как работать с kafka.

## Зависимости:

- docker
- docker-compose

## Команы:

Для всех docker команд подготовлены make команды и есть еще несколько примеров, как запустить consumer и producer.

Подготовлены Dockerfile-ы для рhp и nginx. В самих Dockerfile-х описано каждая команда, для чего, почему. 
С перва собираем образы и запускаем контейнера:

```
make run_containers
```

Можете посмотреть список запушенных контейнеров. Для этого в другом окне терминала выполните следующую команду:

```
docker ps
```

Подключаемся к контейнеру, где находтся наши producer и consumer. Контейнер называется "php-rdkafka":

```
make connect_php_container
```

Теперь запускаем consumer. Внутри контейнера, который мы только что подключились выполняем следующую команду:

---
**NOTE**

Перед тем, как запустить consumer, убедитесь в том, что topic "php_rdkafka" создался. Список topic-ов можете
посмотреть переходив по адресу ``` http://localhost:8080 ```.  Если топик не создался, вы можете создать topic 
здесь ``` http://localhost:8080/ui/clusters/local/topics ```

В этом изображении показано все своиства topic-а, который нужно создать:

![Alt text](./images/php_rdkafka.png?raw=true "Optional Title")

![Alt text](./images/php_rdkafka_settings.png?raw=true "Optional Title")

---

```
php ./public/consumer.php
```

Consumer запустился, и в каждом итерации цикла обращается к topic-у "php_rdkafka", если есть новое сообщение, 
то выводить эту сообщению. 

В другом окне терминала подключитесь к контейнеру "php-rdkafka" и после того как подключились запускайте producer:

```
php ./public/producer.php
```

После запуска producer-а, в другом окне терминала, который запушен consumer, должен выводится сообщение, 
текущая дата в формате "Y-m-d H:i:s".  

### UI for Apache Kafka

Инструмент "UI for Apache Kafka" позволяет нам удобно посмотреть список broker-ов, topic-ов и consumer-ов. Еще можно 
создать новый topic. Ардес "UI for Apache Kafka":

```
http://localhost:8080
```

### Docker. docker-compose.yml файл

... в процессе