<?php

namespace HTML;

trait Validator
{
   private $validator = null;
   
   static
   function hasValidator ( $object )
   {
      return property_exists($object,'validator') && $object->validator !== null;
   }

   function & validator ( $validator )
   {
      $this->validator = $validator;
      return $this;
   }

   function & validate ( $parent=null )
   {
      foreach ( $this->children as &$child )
      {
         if ( ! static::hasValidator($child) ) continue;
         $child->validate($child);
      }

      if ( $this->validator !== null ) call_user_func($this->validator, $this, $parent);
      return $this;
   }
}