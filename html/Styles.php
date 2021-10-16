<?php

namespace HTML;

require_once 'Properties.php';

/**
 * Class to manage the style attribute.
 *
 * @class Styles
 * @file Styles.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class Styles extends Properties
{
   static protected
   function toKebabCase ( $camelcase )
   {
       return strtolower(preg_replace('/(?<!^)([A-Z])/', '-\\1', $camelcase));
   }

   protected
   function explodify ($v)
   {
      return preg_split("/;\s+/", $v);
   }

   protected
   function implodify ($v)
   {
      return implode(';', $v);
   }

   protected
   function cleanify ($v)
   {
      return trim($v);
   }

   protected
   function stringify ($k, $v)
   {
      return sprintf('%s:%s', $k, $v);
   }

   protected
   function unstringify ($v)
   {
      return explode(':', $v, 2);
   }

   protected
   function metamorphosify ($v)
   {
      return self::toKebabCase($v);
   }

   /**
    * Tell is a property exists.
    *
    * @param string $key   A property name.
    * @return boolean   True when found, false otherwise.
    */
   public
   function hasProperty ($key)
   {
      return parent::hasProperty($key);
   }

   /**
    * Get the parameters of the property.
    *
    * @param string $key   A property name.
    * @return string The parameters stored for this property name.
    */
   public
   function getProperty ($key)
   {
      return parent::getProperty($key);
   }

   /**
    * Sets a property and its parameters.
    *
    * @param string $key   The property name.
    * @param string $val   The parameters of the property.
    * @return Attributes   This instance.
    */
   public
   function setProperty ($key, $val)
   {
      return parent::setProperty($key, $val);
   }

   /**
    * Sets the properties and theirs parameters.
    *
    * @param string|array|pair   The properties and parameters to be sets.
    * @return Attributes   This instance.
    */
   public
   function setProperties ()
   {
      return call_user_func_array(array($this, 'parent::setProperties'), func_get_args());
   }
}