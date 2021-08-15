<?php

namespace HTML;

require_once 'Attributes.php';
// traits
require_once 'Element+Errors.php';
require_once 'Element+Initializator.php';
require_once 'Element+Validator.php';
require_once 'Element+Children.php';

require_once 'EmptyTags.php';

use HTML\Attributes;

class Element extends Attributes
{
   const TAG_SIMPLE = '<%1$s %2$s />';
   const TAG_DOUBLE = '<%1$s %2$s>%3$s</%1$s>'; // with child

   use Errors;
   use Initializator;
   use Validator;
   use Children { __toString as private childrenToString; }
   
   static   $id_prefix = '';

   private  $tagname;
   private  $htmltag;

   static
   function isInputType ( $type )
   {
       return preg_match('/button|checkbox|color|date|datetime-local|email|file|hidden|image|month|number|password|radio|range|reset|search|submit|tel|text|time|url|week/i',$type);
   }

   function __construct ( $tagname='form', $attributes=null )
   {
      parent::__construct($attributes);

      if (!isset($attributes['id'])) $this->__set('id', uniqid(static::$id_prefix));
      $this->tagname($tagname);
      $this->htmltag(EmptyTags::match($tagname) ? Element::TAG_SIMPLE : Element::TAG_DOUBLE);

      return $this;
   }

   function id ()
   {
      return $this->__get('id');
   }

   protected
   function tagname ( $name=null )
   {
      if ($name !== null) $this->tagname = $name;
      return $this->tagname;
   }

   protected
   function htmltag ( $html_const )
   {
      $this->htmltag = $html_const;
   }

   protected
   function split_htmltag ()
   {
      return preg_split('# />|</#', $this->htmltag);
   }

   function is ( $tagname )
   {
      return strtolower($this->tagname) === $tagname;
   }

   function isNonContainer ()
   {
      return strpos($this->htmltag, ' />') !== false;
   }

   function & elements ()
   {
      foreach ( $this->children as &$child ) yield $child;
   }

   function open ()
   {
      return sprintf($this->split_htmltag()[0], $this->tagname, parent::__toString(), '');
   }

   function close ()
   {
      return $this->isNonContainer()?' />':'</'.sprintf($this->split_htmltag()[1], $this->tagname);
   }

   protected 
   function ifErrors ( $element )
   {
      if ( $element->hasErrors() ) $this->error($element->errors());
   }

   function __toString()
   {
      return sprintf($this->htmltag, $this->tagname, parent::__toString(), $this->childrenToString());
   }
}