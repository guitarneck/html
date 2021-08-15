<?php

namespace HTML;

require_once 'Properties.php';

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
      return [$v, ''];
   }

   protected
   function metamorphosify ($v)
   {
      return static::toKebabCase($v);
   }

   function hasClass ($key)
   {
      return $this->hasProperty($key);
   }
   
   function getClass ($key)
   {
      return $this->getProperty($key);
   }
   
   function setClass ($key, $val)
   {
      return $this->setProperty($key, $val);
   }
   
   function setClasses ()
   {
      return call_user_func_array(array($this, 'setProperties'), func_get_args());
   }
}