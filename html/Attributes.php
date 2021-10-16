<?php

namespace HTML;

require_once 'Properties.php';

/**
 * Class to manage HTML attributes.
 *
 * @class Attributes
 * @file Attributes.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class Attributes extends Properties
{
   // extracts attributes from a string
   protected
   function explodify ($v)
   {
      return preg_split("/\s+/", $v);
   }

   // create a string from list of attributes
   protected
   function implodify ($v)
   {
      return implode(' ', $v);
   }

   // returns a clean and pure value
   protected
   function cleanify ($v)
   {
      return preg_replace('/^["|\']/', '', preg_replace('/["|\']$/' ,'', $v));
   }

   // prepare the attributes to be a string representation
   protected
   function stringify ($k, $v)
   {
      return sprintf('%s="%s"', $k, $v);
   }

   // split an attribute and its value
   protected
   function unstringify ($v)
   {
      return explode('=', $v, 2);
   }

   // apply a transformation on a key
   protected
   function metamorphosify ($k)
   {
      return $k;
   }

   /**
    * Tell an attribute exists.
    * @param string  $key  The attribute to search.
    * @return bool   True when the attribute exists, false otherwise.
    */
   function hasAttribute ($key)
   {
      return $this->hasProperty($key);
   }

   /**
    * Retrieve the value of an attribute.
    *
    * @param string $key   The attribute name.
    * @return mixed     The value of the attribute.
    */
   function getAttribute ($key)
   {
      return $this->getProperty($key);
   }

   /**
    * Sets an attribute and its value.
    *
    * @param string $key   The attribute name.
    * @param mixed $val    Optional. The value of the attribute.
    * @return Attributes   This instance.
    */
   function setAttribute ($key, $val=null)
   {
      return $this->setProperty($key, $val);
   }

   /**
    * Sets the attributes and theirs values.
    *
    * @param string|array|pair   The attributes to be sets.
    * @return Attributes   This instance.
    */
   function setAttributes ()
   {
      return call_user_func_array(array($this, 'setProperties'), func_get_args());
   }
}