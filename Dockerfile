FROM charlesportwoodii/php:7.2
LABEL maintainer "Charles R. Portwood II <charlesportwoodii@erianna.com>"

ENV REDIS_HOST "redis"
ENV ENV "dev"

WORKDIR /app

COPY . /app

RUN /root/.bin/composer install -ovna --no-dev

ENTRYPOINT ["php", "/app/web/index.php", "--host=0.0.0.0", "--port=8080"]