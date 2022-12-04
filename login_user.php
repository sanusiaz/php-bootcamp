<?php


    
    if (!session_start())
    {
        session_start();
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
            'email',
            'password',
        ];


        foreach($array_check_inputs as $inputKey => $inputValue)
        {
            if (empty($_POST[$inputValue]))
            {
                $_SESSION['error'] = "Fill All Inputs";
            }
        }
     
        $email          = $_POST['email'];
        $password       = $_POST['password'];
        
        
        if ( !isset($_SESSION['error']) )
        {
            
            $email      = mysqli_real_escape_string($conn, $email);
            $password   = mysqli_real_escape_string($conn, $password);
            
            if ( !validating_email($email) ) 
            {
                $_SESSION['error'] = "Invalid Email";
            }
            
            if ( !validate_password($password, 20) )
            {
                $_SESSION['error'] = "Invalid Password MAx 20";
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
                    $stmp->fetch();
                        
                    if ( !password_verify($password, $hashed_password) )
                    {
                        $_SESSION['error'] = "Wrong Password Entered";
                    }    
                    else
                    {

                        // login the users in here
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
        
                        $_SESSION['success'] = "Welcome " . $first_name;
                            
                        unset($_SESSION['error']);
                        header("Location: /admin/dashboard.php");
                        exit();
                    }
    
    
                }
                else
                {   
                    $_SESSION['error'] = "Invalid User";
                }

              
                $stmp->close();
            
            }

            else{
                $_SESSION['error'] = "Error From Query";
            }
        }

           
           
    }
    else
    {

        $_SESSION['error'] = "Unsupported Route";
    }


    mysqli_close($conn);


   // handle way
   echo "<script>" .  "window.location.href = './login.php';" . "</script>";