FROM maxexcloo/nginx-php
VOLUME ["/data/http", "/data/config"]
WORKDIR /data/http
CMD ["make"]
