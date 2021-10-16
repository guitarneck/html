<?php

namespace HTML;

/**
 * Class to manage text.
 *
 * @class Text
 * @file Text.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class Text
{
   private $content;

   /**
    * Constructor.
    *
    * @param string $string  The text content.
    */
   function __construct ( $string )
   {
      $this->content = $string;
   }

   /**
    * Sets the content.
    *
    * @param string $string   The content to sets.
    * @return Text   This instance;
    */
   function content ( $string )
   {
      $this->content = $string;
      return $this;
   }

   function __toString ()
   {
      return $this->content;
   }
}