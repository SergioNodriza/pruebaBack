SHELL := /bin/bash

## docker-compose

.PHONY: start
start: #docker-login
	#@mkdir -p config/jwt
	docker network create prueba-back-network || true
	docker-compose up -d

.PHONY: restart
restart: stop start

.PHONY: stop
stop:
	docker-compose down

.PHONY: build
build: docker-login
	docker-compose build

.PHONY: rebuild
rebuild: build restart

.PHONY: docker-login
docker-login:
	@aws --profile default ecr get-login-password --region eu-west-1 | \
	docker login -u AWS --password-stdin 534422648921.dkr.ecr.eu-west-1.amazonaws.com 2>/dev/null

## login shells

.PHONY: sh-api
sh-api: start
	docker exec -e APP_ENV=dev -ti -u1000 prueba-back-api sh -l

## QoL

.PHONY: supervisor-ui
supervisor-ui: start
	xdg-open user:pass@api.prueba-back.local:9001