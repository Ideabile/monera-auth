dev: docker-compose.yml
	mkdir -p ./www && \
	export CONTENT="$(shell pwd)/ui" && \
	export SRC="$(shell pwd)/generator/src" && \
	export STYLE="$(shell pwd)/generator/style" && \
	export DEST="$(shell pwd)/generator/destination" && \
	$(MAKE) -C generator dev

install: src/Makefile
	$(MAKE) -C src install && \
	$(MAKE) -C src build

build: install
	docker-compose build auth

schema: docker-compose.yml
	docker-compose run auth schema

fixtures: docker-compose.yml
	docker-compose run auth fixtures

prod: docker-compose.yml
	docker-compose up -d

stop: docker-compose.yml
	docker-compose kill && \
	docker-compose rm -f

.PHONY: dev
