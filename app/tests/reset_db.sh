#!/bin/bash
set -x

mariadb -h host.docker.internal -u gila -ptest_db_password gila < /opt/app/tests/sql/test_data.sql