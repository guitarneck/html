<?php

namespace HTML;

trait Errors
{
    private  $errors = array();

    function error ( $msg )
    {
        if ( is_array($msg) )
            $this->errors = array_merge($this->errors, $msg);
        else
            $this->errors[] = $msg;
    }

    function hasErrors ()
    {
        return count($this->errors) > 0;
    }

    function errors ()
    {
        return $this->errors;
    }
}