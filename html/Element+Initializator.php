<?php

namespace HTML;

trait Initializator
{
   private $initializator = null;
   
   static
   function hasInitializator ( $object )
   {
      return property_exists($object,'initializator') && $object->initializator !== null;
   }

   function & initializator ( $initializator )
   {
      $this->initializator = $initializator;
      return $this;
   }   

   function & initialize ( $parent=null )
   {
      foreach ( $this->children as &$child )
      {
         if ( ! static::hasInitializator($child) ) continue;
         $child->initialize($child);
      }

      if ( $this->initializator !== null ) call_user_func($this->initializator, $this, $parent);
      return $this;
   }
}