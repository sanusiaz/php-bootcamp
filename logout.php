<?php

    if ( !session_start() )
    {
        session_start();
    }


    foreach ($_SESSION as $sessionKey => $sessionVal)
    {
        unset($_SESSION[$sessionKey]);
    }


    $_SESSION['error'] = "You Have Been Logged Out";
    header("Location: ./login.php");

?>