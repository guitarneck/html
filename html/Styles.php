<?php

namespace HTML;

require_once 'Properties.php';

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

   public
   function hasProperty ($key)
   {
      return parent::hasProperty($key);
   }

   public
   function getProperty ($key)
   {
      return parent::getProperty($key);
   }
   
   public
   function setProperty ($key, $val)
   {
      return parent::setProperty($key, $val);
   }
   
   public
   function setProperties ()
   {
      return call_user_func_array(array($this, 'parent::setProperties'), func_get_args());
   }
}