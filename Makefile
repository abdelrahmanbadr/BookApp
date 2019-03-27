BIN_DOCKER = 'docker'
BIN_DOCKER_COMPOSE = 'docker-compose'


CONTAINER_NGINX = yaraku_nginx
CONTAINER_PHP72 = yaraku_php72
CONTAINER_MYSQL = yaraku_mysql

clear_all: clear_containers clear_images

clear_containers:
	$(BIN_DOCKER) stop `$(BIN_DOCKER) ps -a -q` && $(BIN_DOCKER) rm `$(BIN_DOCKER) ps -a -q`

stop_all_containers:
	$(BIN_DOCKER) stop `$(BIN_DOCKER) ps -a -q`

clear_images:
	$(BIN_DOCKER) rmi -f `$(BIN_DOCKER) images -q`

build:
	$(BIN_DOCKER_COMPOSE) build

up:
	$(BIN_DOCKER_COMPOSE) up
hosts:
	sh ./update-hosts.sh

phpunit_test:
	$(BIN_DOCKER_COMPOSE) exec $(CONTAINER_PHP72) ./vendor/bin/phpunit

up_background:
	$(BIN_DOCKER_COMPOSE)  up -d

down:
	$(BIN_DOCKER_COMPOSE)  stop

logs_nginx:
	$(BIN_DOCKER) logs -t -f $(CONTAINER_NGINX)

php_composer_install:
	$(BIN_DOCKER_COMPOSE) exec $(CONTAINER_PHP72) composer install

permissions:
	$(BIN_DOCKER_COMPOSE) exec $(CONTAINER_PHP72) chmod 777 -R storage/
	$(BIN_DOCKER_COMPOSE) exec $(CONTAINER_PHP72) chmod 777 -R public/

mysql_migrate:
	$(BIN_DOCKER_COMPOSE) exec $(CONTAINER_PHP72) php artisan migrate

init: build hosts up_background php_composer_install permissions  mysql_migrate
