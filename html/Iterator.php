<?php

namespace HTML;

/**
 * Iterator class.
 *
 * @class Iterator
 * @file Iterator.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class Iterator implements \Iterator
{
   private $attributes;

   public function __construct( $attributes )
   {
      $this->attributes = get_object_vars($attributes);
   }

   function rewind () { return reset($this->attributes); }
   function current () { return current($this->attributes); }
   function key () { return key($this->attributes); }
   function next () { return next($this->attributes); }
   function valid () { return $this->key() !== null; }
}