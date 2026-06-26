PHP_UID = $(shell id -u)
PHP_GID = $(shell id -g)

DOCKER_COMPOSE := PHP_UID=$(PHP_UID) PHP_GID=$(PHP_GID) docker compose

##
##
##-------------

## ## ##Docker ##-------------
inituser: ## Generate the docker/conf/pool-dev.conf file for the php-fpm to have the right user permission in the container
inituser:
	cp docker/dev/php/conf/pool.conf docker/dev/php/conf/pool-dev.conf
	sed -i -e 's/user = www-data/user = $(PHP_UID)/g' docker/dev/php/conf/pool-dev.conf
	sed -i -e 's/group = www-data/group = $(PHP_GID)/g' docker/dev/php/conf/pool-dev.conf
.PHONY:inituser

build: ## build and up docker container build: compose.yaml inituser
	$(DOCKER_COMPOSE) up -d --build
.PHONY: build

symfony-new: build ## Create Symfony 8.1 project
	$(DOCKER_COMPOSE) run --rm php bash ./bin/install-symfony.sh
.PHONY: symfony-new

composer-install: ## Run composer install
install: build
	$(DOCKER_COMPOSE) run --rm php composer install
.PHONY: composer-install

start: ## Start the Docker containers
start: compose.yaml
	$(DOCKER_COMPOSE) up -d
.PHONY: start


# DEFAULT
.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
