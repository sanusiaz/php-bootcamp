<?php

    $isLoggedIn = false;
    if ( !session_start() )
    {
        session_start();
    }

    $connection_file = dirname(__FILE__, 2) . './database/connect_database.php';
    if ( file_exists( $connection_file ) ) 
    {
        include_once $connection_file;
        

        // check if the email and password is valid
        $email = (isset($_SESSION['email'])) ? $_SESSION['email'] : '';
        $password = ( isset($_SESSION['password']) ) ? $_SESSION['password'] : '';


        // from the db chekc the email 
        if ( $checkUser = $conn->prepare("SELECT email, password FROM users WHERE email = ?") )
        {
            $checkUser->bind_param("s", $email);
            $checkUser->execute();
            $checkUser->store_result();

            if ( $checkUser->num_rows > 0 )
            {   
                $isLoggedIn = true; 
            }
            $checkUser->close();
        }

        mysqli_close($conn);
    }



    if ( !$isLoggedIn )
    {
        $_SESSION['error'] = "Please Login / Create an Account";
        header("Location: ../login.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Admin Hit Here


    <a href="../logout.php">Click To Logout</a>

    
    <?php if(!empty($error_message)):?>
        <div class="text-red text-sm p-3 overflow-hidden px-7 truncate text-ellipsis text-red-600 max-w-[200px] sm:max-w-[350px] md:max-w-[400px] fixed bottom-2 right-2 border-red-600 bg-red-300">
            <?= $error_message;?>
        </div>
    <?php endif;?>


    <?php if(!empty($success_message)):?>
        <div class="text-green text-sm p-3 overflow-hidden px-7 truncate text-ellipsis text-green-600 max-w-[200px] sm:max-w-[350px] md:max-w-[400px] fixed bottom-2 right-2 border-green-600 bg-green-300">
            <?= $success_message;?>
        </div>
    <?php endif;?>




    <?php
    
        if ( isset($_SESSION['success']) )
        {
            unset($_SESSION['success']);
        }


        if ( isset($_SESSION['error']) )
        {
            unset($_SESSION['error']);
        }
    ?>
</body>
</html>