<?php

namespace HTML;

/**
 * Trait to manage the errors of an Element.
 *
 * @class Errors
 * @file Element+Errors.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
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