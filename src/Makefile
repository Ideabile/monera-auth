build-composer: composer.json
	composer install

build: build-composer
	./vendor/bin/propel sql:build --overwrite && \
	./vendor/bin/propel model:build

schema: generated-sql/sqldb.map
	./vendor/bin/propel sql:insert

.PHONY: build
