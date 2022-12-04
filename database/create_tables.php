<?php

    include_once dirname(__FILE__) . './connect_database.php';

    // create users table
    $tables[] = [
        "Name" => "users",
        "Query" => "CREATE TABLE IF NOT EXISTS users(
            id int(11) PRIMARY KEY auto_increment,
            first_name varchar(100) NOT NULL,
            last_name varchar(100) NOT NULL,
            username varchar(50) NOT NULL,
            email varchar(500) UNIQUE NOT NULL
        )
        ENGINE=InnoDB,CHARSET=utf8"
    ];


    $tables[] = [
        "Name" => "posts",
        "Query" => "CREATE TABLE IF NOT EXISTS posts(
            id int(11) auto_increment PRIMARY KEY,
            user_id int(11) ,
            post_name  varchar(100) UNIQUE NOT NULL,
            post_type varchar(50) NOT NULL,
            is_published int(1) DEFAULT 0,
            slug varchar(50) UNIQUE NOT NULL,
            message TEXT NOT NULL
        )
        ENGINE=InnoDB,CHARSET=utf8"
    ];

    // $queries[] = "ALTER TABLE users 
    //                 ADD CONSTRAINT user_to_posts_2 
    //                 FOREIGN KEY (id) 
    //                     REFERENCES posts(user_id) 
    //                 ON DELETE CASCADE";  
    
    
    
    $queries[] = "ALTER TABLE users 
                    ADD COLUMN password 
                    TEXT NOT NULL";  

    foreach( $tables as $table )
    {

        $query = mysqli_query($conn, $table["Query"]);
        if ( mysqli_error($conn) )
        {
            die("An Error Occurred In Creating " . $table["Name"] . " Table <br>");
        }
        else 
        {
            echo $table["Name"] . " Table Was Created Successfully <br>";
        }
    }


    foreach ($queries as $sql_query)
    {
        $raw_query = mysqli_query($conn, $sql_query);

        // check if there is error in query 
        if ( mysqli_error($conn) )
        {
            die("An error Occurred In Performing Query " . mysqli_error($conn));
        }
       
    }