<?php

namespace HTML;

require_once 'Properties.php';

/**
 * Class to manage the class attributes. The class name are kebab cased.
 *
 * @class Classes
 * @file Classes.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class Classes extends Properties
{
   static protected
   function toKebabCase ( $camelcase )
   {
       return strtolower(preg_replace('/(?<!^)([A-Z])/', '-\\1', $camelcase));
   }

   protected
   function explodify ($v)
   {
      return preg_split("/\s+/", $v);
   }

   protected
   function implodify ($v)
   {
      return implode(' ', array_filter($v,function($v){return $v!==null;}));
   }

   protected
   function cleanify ($v)
   {
      return trim($v);
   }

   protected
   function stringify ($k, $v)
   {
      if ( is_callable($v) ) $v = call_user_func_array($v,array(&$k));
      return ($v === '') || ($v === true) || ($v == 1) ? $k : null;
   }

   protected
   function unstringify ($v)
   {
      return array($v, '');
   }

   protected
   function metamorphosify ($v)
   {
      return static::toKebabCase($v);
   }

   /**
    * Tell is a class exists.
    *
    * @param string $key   A class name.
    * @return boolean   True when found, false otherwise.
    */
   function hasClass ($key)
   {
      return $this->hasProperty($key);
   }

   /**
    * Get the display status of the class.
    *
    * @param string $key   A class name.
    * @return string|bool|int  The value stored for this class name.
    */
   function getClass ($key)
   {
      return $this->getProperty($key);
   }

   /**
    * Sets a class name and its displayable value.
    *
    * @param string $key   A class name.
    * @param string|bool|int  $val  The displayable value to store for this class name.
    * @return void
    */
   function setClass ($key, $val)
   {
      return $this->setProperty($key, $val);
   }

   /**
    * Sets the classes and theirs values.
    *
    * @param string|array|pair   The classes to be sets.
    * @return Attributes   This instance.
    */
   function setClasses ()
   {
      return call_user_func_array(array($this, 'setProperties'), func_get_args());
   }
}