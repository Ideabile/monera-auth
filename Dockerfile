FROM maxexcloo/nginx-php
VOLUME ["/data/http", "/data/config"]

ENV DB_HOST localhost
ENV DB_NAME auth
ENV DB_PORT 5432
ENV DB_USER root
ENV DB_PASSWORD root

RUN apt-get install -y curl && \
    apt-get install -y make && \
    curl -sS https://getcomposer.org/installer | php

WORKDIR /data/http
RUN make
