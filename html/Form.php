<?php

namespace HTML;

require_once 'Element.php';

/**
 * Class to manage Form HTML element.
 *
 * @class Form
 * @file Form.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class Form extends Element
{
   const   ENCTYPE_DATA = "multipart/form-data";
   const   ENCTYPE_ENCODED = "application/x-www-form-urlencoded";

   function __construct( $attributes )
   {
      parent::__construct('form', $attributes);
      if (!isset($this->method)) $this->method = 'post';
   }

   private
   function sanytize ( $value )
   {
      return is_array($value) ? array_map('trim',$value) : array(trim($value));
   }

   private
   function normalize ( $name )
   {
      return str_replace('[]', '', trim($name));
   }

   function isSubmitted ( $array=null )
   {
      if ($array === null) $array = $_REQUEST;
      if (!empty($_FILES)) $array = array_merge($array, array_flip(array_keys($_FILES)));
      $submitted = false;

      foreach ($this->elements() as &$child)
      {
         if ( ! property_exists($child,'name') ) continue;
         $name = $this->normalize($child->name);
         if ($name === '') continue;

         if ( isset($array[$name]) )
         {
            $submitted = true;

            $value = $this->sanytize($array[$name]);
            $child->validate($value);

            $this->ifErrors($child);

            if ($child->is('select')) $this->updateSelect($child, 'selected', $value);
            if ($child->is('checkbox')) $this->updateCheckbox($child, 'checked', $value);
         }
      }

      if ( !$submitted ) $this->initialize();

      return $submitted;
   }

   private
   function updateSelect ( $box, $prop='selected', $value )
   {
<<<<<<< HEAD
      foreach ($boxes as &$box) // il faut les values du parent
      {
         $children = array();
         if ($box->length() === 0)
            $children[] = &$box;
         else
            foreach ($box->elements() as &$element)
            {
               $children[] = &$element;
               foreach ($element->elements() as &$child) $children[] = &$child;
            }
=======
      $children = array();
      if ($box->length() === 0)
         $children[] = &$box;
      else
         foreach ($box->elements() as &$element)
         {
            $children[] = &$element;
            if ( Children::hasChildren($element) ) foreach ($element->elements() as &$child) $children[] = &$child;
         }
>>>>>>> issue with multichildren level

      foreach ($children as &$child)
      {
         if (!is_a($child, Element::class) || !isset($child->value) || empty($child->value)) continue;

         if (in_array($child->value, $value))
            $child->setAttribute($prop, null);
         else
            unset($child->$prop);
      }
   }

   private
   function updateCheckbox ( & $child, $prop='checked', $value )
   {
      if (in_array($child->value, $value) || in_array('on', $value))
         $child->setAttribute($prop, null);
      else
         unset($child->$prop);
   }
}