<?php
function resetDatabase($file) : void
{
    $command = sprintf('mariadb -h %s -u %s -p%s %s < /opt/app/tests/sql/fixture/%s.sql', $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD'], $GLOBALS['DB_DATABASE'], $file);
    shell_exec($command);
}

