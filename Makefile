dev: docker-compose.yml
	mkdir -p ./www && \
	export TASK="dev" && \
	docker-compose up -d

build: docker-compose.yml
	docker-compose run auth make build

schema: docker-compose.yml
	docker-compose run auth make schema

fixtures: docker-compose.yml
	docker-compose run auth make fixtures

prod: docker-compose.yml
	docker-compose up auth -d

stop: docker-compose.yml
	docker-compose kill && \
	docker-compose rm -f

.PHONY: dev
