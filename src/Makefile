install: composer.json
	composer install --prefer-dist 

build: ./vendor/bin/propel
	./vendor/bin/propel sql:build --overwrite && \
	./vendor/bin/propel config:convert && \
	./vendor/bin/propel model:build

fixtures: fixtures.yml
	php fixtures.php

schema: generated-sql/sqldb.map
	./vendor/bin/propel sql:insert

.PHONY: build
