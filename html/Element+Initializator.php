<?php

namespace HTML;

/**
 * Trait to manage the initializator of an Element.
 *
 * @class Initializator
 * @file Element+Initializator.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
trait Initializator
{
   private $initializator = null;

   /**
    * Telle if an initializator exists.
    *
    * @static
    * @param Element $object  An element instance.
    * @return boolean   Ture if exists, false otherwise.
    */
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

   function & initialize ()
   {
      foreach ( $this->children as &$child )
      {
         if ( ! static::hasInitializator($child) ) continue;
         $child->initialize();
      }

      if ( $this->initializator !== null ) call_user_func($this->initializator, $this);
      return $this;
   }
}