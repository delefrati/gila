<?php
function resetDatabase() : void
{
    session_write_close();
    $command = sprintf('mariadb -h %s -u %s -p%s %s < /opt/app/tests/sql/test_data.sql', $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD'], $GLOBALS['DB_DATABASE']);
    //$command = '/opt/app/tests/reset_db.sh';
    //var_dump($command);


    shell_exec($command);
    // pclose(popen($command, "r"));
    //var_dump( passthru($command));
}

resetDatabase();