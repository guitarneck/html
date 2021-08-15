<?php

namespace HTML;

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

   static
   function match ( $tagname )
   {
      return in_array(strtolower($tagname),static::$tags);
   }
}