FROM php:7.4-cli
LABEL org.opencontainers.image.authors="jeandelefrati@gmail.com"

RUN docker-php-ext-install pdo_mysql
WORKDIR /opt/app/

ENV DB_DSN 'mysql:host=host.docker.internal;dbname=gila'
ENV DB_USER 'gila'
ENV DB_PASSWORD 'test_db_password'

CMD [ "./entrypoint.sh" ]