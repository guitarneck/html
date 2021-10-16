<?php

namespace HTML;

/**
 * Class to detect boolean attributes.
 *
 * @class BooleanAttributes
 * @file BooleanAttributes.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
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

   /**
    * Tell if an attribute name is of boolean type.
    *
    * @static
    * @param string $attribute   The attribute to test.
    * @return bool   True when it is a boolean attribute, false otherwise.
    */
   static
   function match ( $attribute )
   {
      return isset(static::$attributes[strtolower($attribute[0])])
          && in_array(strtolower($attribute),static::$attributes[strtolower($attribute[0])]);
   }
}