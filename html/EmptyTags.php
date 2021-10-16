<?php

namespace HTML;

/**
 * Class to detect a non container HTML element.
 *
 * @class EmptyTags
 * @file EmptyTags.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class EmptyTags
{
   static private
   $tags = array(
      'area',
      'base',
      'br',
      'col',
      'embed',
      'hr',
      'img',
      'input',
      'link',
      'meta',
      'param',
      'source',
      'track',
      'wbr'
   );

   /**
    * Tell if a HTML element is a non container tag.
    *
    * @static
    * @param string $tagname   The tagname to test.
    * @return bool   True when it is a non container, false otherwise.
    */
   static
   function match ( $tagname )
   {
      return in_array(strtolower($tagname),static::$tags);
   }
}