<?php

    if (!session_start())
    {
        session_start();
    }


    // remove the success message 
    if ( isset($_SESSION['success']) )
    {
        unset($_SESSION['success']);
    }


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
                $_SESSION['error'] = "Fill All Inputs";
            }
        }

        if ( !isset($_SESSION['error']) ) 
        {

            $firstname      = $_POST['first_name'];
            $lastname       = $_POST['last_name'];
            $username       = $_POST['username'];
            $email          = $_POST['email'];
            $password       = $_POST['password'];
            $re_password    = $_POST['confirm_password'];
    
           
            // validating input
            // if ( !validate_text($firstname) || !validate_text($lastname) || !validate_text($username) ) 
            // {
            //     $_SESSION['error'] = "Invalid text input";
            // }
            

            
            $replaced_firstname = preg_replace("#[^a-zA-Z0-9]#", "", $firstname);
            $replaced_username = preg_replace("#[^a-zA-Z0-9]#", "", $username);
            $replaced_lastname = preg_replace("#[^a-zA-Z0-9]#", "", $lastname);


            if ( $firstname !== $replaced_firstname ) {
                $_SESSION['error'] = "Invalid Firstname";
            }  

            if ( $lastname !== $replaced_lastname ) {
                $_SESSION['error'] = "Invalid Lastname";
            }  
            if ( $username !== $replaced_username ) {
                $_SESSION['error'] = "Invalid Username";
            }  
            


            if ( !isset($_SESSION['error']) )
            {
                
                $username   = mysqli_real_escape_string($conn, $username);
                $email      = mysqli_real_escape_string($conn, $email);
                $password   = mysqli_real_escape_string($conn, $password);
                $firstname  = mysqli_real_escape_string($conn, $firstname);
                $lastname   = mysqli_real_escape_string($conn, $lastname);
    
    
        
                if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) 
                {
                    $_SESSION['error'] = "Invalid Email";
                }
        
                if ( !validate_password($password, 20) )
                {
                    $_SESSION['error'] = "Max Length for password is 20:";
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
                            $_SESSION['error'] = "Account Exists with email " . $email;
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
        
                                    // send email to users
                                    $_SESSION['success'] = "Account Has Been Created Successfully";

                                    
                                    unset($_SESSION['error']);
                                    header("Location: ./login.php");
                                    exit();
                                }
                                
                                
                                $createAccount->close();
                            }
                           
                        }
        
                        $stmp->close();
                    
                    }
                   
                }  
                else 
                {
                    $_SESSION['error'] = "Password Does Not Match";
                }      
            }
        }


    }
    else
    {
        $_SESSION['error'] = "Unsupported Route";
    }


    mysqli_close($conn);

    // handle way
    echo "<script>" .  "window.location.href = './signup.php';" . "</script>";