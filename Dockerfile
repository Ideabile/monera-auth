#
# Monera-auth
#
# VERSION                1.0.0
FROM maxexcloo/nginx-php
MAINTAINER Mauro Mandracchia <info@ideabile.com>
LABEL Description="Create an Authentication gateway" Vendor="ideabile.com" Version="1.0.1"
VOLUME ['/data/http', '/data/config/', '/data/logs']
ENV MAIN=./
ENV DEST=/data/http

ADD ${main}config /data/config

ENV DB_HOST localhost
ENV DB_NAME auth
ENV DB_PORT 5432
ENV DB_USER root
ENV DB_PASSWORD root

WORKDIR ${DEST}/
RUN apt-get install -y curl && \
    apt-get install -y make && \
    curl -sS https://getcomposer.org/installer | php

# ADD ${MAIN}src/Makefile ${DEST}/Makefile
# ADD ${MAIN}composer.json ${DEST}/composer.json
# ADD ${MAIN}composer.lock ${DEST}/composer.lock

ADD $MAIN/src ${DEST}
RUN make build
RUN apt-get clean
