<?php

    if (file_exists(dirname(__FILE__) . './config.php'))
    {
        require_once dirname(__FILE__) . './config.php';
        $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT, DB_PREFIX);

        if ( !$conn )
        {
            die("An error occurred in connecting to database " );
        }
        else 
        {
            echo "Connection Was made successfully to database <br>" ;
        }
    }
    else 
    {
        die("Database config file does not exists");
    }