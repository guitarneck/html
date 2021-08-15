<?php

namespace HTML;

class BooleanAttributes
{
   static private
   $attributes = array(
      'a'   => array(
         'allowfullscreen',
         'allowpaymentrequest',
         'async',
         'autofocus',
         'autoplay'
      ),
      'c'   => array(
         'checked',
         'controls'
      ),
      'd'   => array(
         'default',
         'disabled'
      ),
      'f'   => array(
         'formnovalidate'
      ),
      'h'   => array(
         'hidden'
      ),
      'i'   => array(
         'ismap',
         'itemscope'
      ),
      'l'   => array(
         'loop'
      ),
      'm'   => array(
         'multiple',
         'muted'
      ),
      'n'   => array(
         'nomodule',
         'novalidate'
      ),
      'o'   => array(
         'open'
      ),
      'p'   => array(
         'playsinline'
      ),
      'r'   => array(
         'readonly',
         'required',
         'reversed'
      ),
      's'   => array(
         'selected'
      ),
      't'   => array(
         'truespeed'
      )
   );

   static
   function match ( $attribute )
   {
      return isset(static::$attributes[strtolower($attribute[0])]) 
          && in_array(strtolower($attribute),static::$attributes);
   }
}