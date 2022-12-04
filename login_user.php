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
            'email',
            'password',
        ];


        foreach($array_check_inputs as $inputKey => $inputValue)
        {
            if (empty($_POST[$inputValue]))
            {
                die("Fill all Inputs " . $inputValue);
            }
        }
     
        $email          = $_POST['email'];
        $password       = $_POST['password'];

        if ( !validating_email($email) ) 
        {
            die("Invalid Email");
        }

        if ( !validate_password($password, 20) )
        {
            die("The Max is 20 ");
        }


        // check the user if account account has not been created before
        if ( $stmp = $conn->prepare("SELECT first_name, last_name, password as hashed_password FROM users WHERE email = ?") )
        {
            $stmp->bind_param("s", $email);
            $stmp->execute();
            $stmp->store_result();

            if ( $stmp->num_rows > 0 )
            {
                $stmp->bind_result($first_name, $last_name, $hashed_password);


                if ( !password_verify($password, $hashed_password) )
                {
                    die("Invalid Password Entered");
                }



                // login the users in here
                
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
        echo json_decode("Unsupported Route");
    }


    mysqli_close($conn);