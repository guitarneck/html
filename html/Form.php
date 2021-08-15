<?php

namespace HTML;

require_once 'Element.php';

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
      return is_array($value) ? implode(',', $value) : $value;
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

      $selBoxes   = array();
      $chkBoxes   = array();

      foreach ($this->elements() as &$child)
      {
         $name = $this->normalize($child->name);
         if ($name === '') continue;

         if ( isset($array[$name]) )
         {
            $submitted = true;

            $child->value = $this->sanytize($array[$name]);
            $child->validate();
            
            $this->ifErrors($child);

            if ($child->is('select')) $selBoxes[] = &$child;
            if ($child->is('checkbox')) $chkBoxes[] = &$child;
         }
      }

      $this->updateBoxes($selBoxes, 'selected');
      $this->updateBoxes($chkBoxes, 'checked');

      if ( !$submitted ) $this->initialize();

      return $submitted;
   }

   private
   function updateBoxes ( $boxes=array(), $prop='selected' )
   {
      foreach ($boxes as &$box) // il faut les values du parent
      {
         $children = array();
         foreach ($box->elements() as &$element)
         {
            $children[] = &$element;
            foreach ($element->elements() as &$child) $children[] = &$child;
         }

         foreach ($children as &$child)
         {
            if (!is_a($child, Element::class) || !isset($child->value)) continue;

            if (strpos($box->value, $child->value) !== false)
               $child->setAttribute($prop, null);
            else
               unset($child->$prop);
         }

         unset($box->value);
      }
   }
}