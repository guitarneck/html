<?php

namespace HTML;

require_once 'Iterator.php';
use HTML\Iterator;

class Properties extends \stdClass
{
   function __construct ()
   {
      if ( func_num_args() > 0 ) call_user_func_array(array($this, 'setProperties'), func_get_args());
   }

   // extracts attributes inside a string
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

   protected
   function hasProperty ($key)
   {
      return $this->__isset($key);
   }
   
   protected
   function getProperty ($key)
   {
      return $this->__get($key);
   }
   
   protected
   function setProperty ($key, $val)
   {
      $this->__set($key, $val);
      return $this;
   }
   
   protected
   function setProperties ()
   {
      if ( func_num_args() > 1 )
      {
         $this->setProperty(func_get_arg(0), func_get_arg(1));
      }
      else
      {
         $key = func_get_arg(0);
         if ( is_array($key) && count($key) > 0 )
         {
            foreach( $key as $k => $v ) $this->__set($k, $v);
         }
         elseif ( is_string($key) && strlen(trim($key)) > 0 )
         {
            foreach( $this->explodify($key) as $v )
            {
               $s = $this->unstringify($v);
               $this->__set($s[0], $this->cleanify($s[1]));
            }
         }
      }
      return $this;
   }

   function __set ($k, $v=null)
   {
      $k = $this->metamorphosify($k);
      $this->{$k} = $v;
   }

   function __get ($k)
   {
      $k = $this->metamorphosify($k);
      return $this->{$k};
   }
   
   function __isset ($k)
   {
      $k = $this->metamorphosify($k);
      return property_exists($this, $k);
   }
   
   function __unset ($k)
   {
      $k = $this->metamorphosify($k);
      unset($this->{$k});
      return $this->__isset($k);
   }

   function iterator ()
   {
      return new Iterator($this);
   }

   function __toString()
   {
      $props = get_object_vars($this);
      array_walk($props,function (&$v, $k){
         $v = $v === null ? $k : $this->stringify($k, $v);
      });
      return $this->implodify($props);
   }
}