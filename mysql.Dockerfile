FROM mysql:5.7
LABEL org.opencontainers.image.authors="jeandelefrati@gmail.com"

ENV MYSQL_DATABASE 'gila'
ENV MYSQL_USER 'gila'
ENV MYSQL_PASSWORD 'test_db_password'
ENV MYSQL_ROOT_PASSWORD 'root_db_password'