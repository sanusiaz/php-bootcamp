<?php

    $validator_function = dirname(__FILE__) . './functions/validators/functions.php';
    $database_connection_file = dirname(__FILE__) . './database/connect_database.php';

    if ( file_exists( $validator_function ) && file_exists( $database_connection_file ) )
    {
        include_once $validator_function;
        include_once $database_connection_file;
    }

    if ( $_POST )
    {

        $array_check_inputs = [
            'first_name',
            'last_name',
            'username',
            'password',
            'email',
            'confirm_password'
        ];


        foreach($array_check_inputs as $inputKey => $inputValue)
        {
            if (empty($_POST[$inputValue]))
            {
                die("Fill all Inputs " . $inputValue);
            }
        }


        $firstname      = $_POST['first_name'];
        $lastname       = $_POST['last_name'];
        $username       = $_POST['username'];
        $email          = $_POST['email'];
        $password       = $_POST['password'];
        $re_password    = $_POST['confirm_password'];

       
        // validating input
        if ( !validate_text($firstname) || !validate_text($lastname) || !validate_text($username) ) 
        {
            die("Invalid firstname");
        }


        if ( !validating_email($email) ) 
        {
            die("Invalid Email");
        }

        if ( !validate_password($password, 20) )
        {
            die("The Max is 20 ");
        }

        
        if ( $password === $re_password )
        {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // check the user if account account has not been created before
            if ( $stmp = $conn->prepare("SELECT first_name FROM users WHERE email = ?") )
            {
                $stmp->bind_param("s", $email);
                $stmp->execute();
                $stmp->store_result();

                if ( $stmp->num_rows > 0 )
                {
                    $stmp->bind_result($first_name);
                    // accou t has been created before
                    die("An Account exists in this email " . $email);
                }
                else 
                {

                    // create an account for users
                
                    if ($createAccount = $conn->prepare("INSERT INTO users(first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)"))
                    {
                        $createAccount->bind_param("sssss", $firstname, $lastname, $email, $username, $hashed_password);
                        
                        if ( $createAccount->execute() )
                        {
                            $createAccount->store_result();

                            echo "Account Has Been Created Successfully";


                            // send email to users
                        }
                        
                        
                        $createAccount->close();
                    }
                   
                }

                $stmp->close();
            
            }
           
        }  
        else 
        {
            die("Passwords does not match");
        }      
    }
    else
    {
        echo json_decode("Unsupported Route");
    }


    mysqli_close($conn);