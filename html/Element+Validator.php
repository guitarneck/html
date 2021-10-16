<?php

namespace HTML;

/**
 * Trait to manage the validator of an Element.
 *
 * @class Validator
 * @file Element+Validator.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
trait Validator
{
   private $validator = null;

   /**
    * Tell if a validator exists.
    *
    * @static
    * @param Element $object  An element instance.
    * @return boolean   Ture if exists, false otherwise.
    */
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

   function & validate ( $value=null )
   {
      foreach ( $this->children as &$child )
      {
         if ( ! static::hasValidator($child) ) continue;
         $child->validate($value);
      }

      if ( $this->validator !== null ) call_user_func($this->validator, $this, $value);
      return $this;
   }
}