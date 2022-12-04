<?php

    /**
     * Validating text
     *
     * @param string $text
     * @return boolean|string
     */
    function validate_text( string $text, int $strlen = 0) : bool|string
    {
        if ( !empty($text) )
        {
            if ( preg_match("/^[a-zA-Z0-9]+$/", $text) )
            {
                $text = preg_replace("#[^a-zA-Z0-9]#", "", $text);

                return ( strlen($text) >= $strlen ) ? true : false;
            }
        }

        return false;
    }


    /**
     * Validate Password
     *
     * @param string $text
     * @param integer $pwd_len
     * @return boolean|string
     */
    function validate_password(string $text, int $pwd_len) : bool|string
    {
        return ( strlen($text) >= $pwd_len ) ? true : false;
    }


    /**
     * validating email 
     *
     * @param string $email
     * @return boolean|string
     */
    function validating_email( string $email) : bool|string
    {

        if ( !empty($email) )
        {
            if ( preg_match("/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})+$/", $email) )
            {
                return true;
            }
        }


        return false;
    }

?>