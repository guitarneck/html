<?php

namespace HTML;

require_once 'Properties.php';

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

   function hasAttribute ($key)
   {
      return $this->hasProperty($key);
   }

   function getAttribute ($key)
   {
      return $this->getProperty($key);
   }

   function setAttribute ($key, $val=null)
   {
      return $this->setProperty($key, $val);
   }

   function setAttributes ()
   {
      return call_user_func_array(array($this, 'setProperties'), func_get_args());
   }
}