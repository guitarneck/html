<?php

namespace HTML;

class Text
{
   private $content;

   function __construct ( $string )
   {
      $this->content = $string;
   }

   function __toString ()
   {
      return $this->content;
   }
}