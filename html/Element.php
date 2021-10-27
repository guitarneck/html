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

/**
 * Class to manage HTML Elements.
 *
 * @class Element
 * @file Element.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 * @extends Attributes
 * @extends Errors
 * @extends Initializator
 * @extends Validator
 * @extends Children
 */
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

   /**
    * Tell if type attribute is a valid input type.
    *
    * @static
    * @param string $type  The type of the input element.
    * @return boolean   True when it's an input type, false otherwise.
    */
   static
   function isInputType ( $type )
   {
       return preg_match('/button|checkbox|color|date|datetime-local|email|file|hidden|image|month|number|password|radio|range|reset|search|submit|tel|text|time|url|week/i',$type);
   }

   /**
    * Constructor.
    *
    * @param string $tagname  The tagname of the element.
    * @param string|array|pair $attributes   The attributes to be sets.
    */
   function __construct ( $tagname='form', $attributes=null )
   {
      parent::__construct($attributes);

      if (!isset($attributes['id'])) $this->__set('id', uniqid(static::$id_prefix));
      $this->tagname($tagname);
      $this->htmltag(EmptyTags::match($tagname) ? Element::TAG_SIMPLE : Element::TAG_DOUBLE);

      return $this;
   }

   /**
    * Retrive the id of the element.
    *
    * @return string The id.
    */
   function id ()
   {
      return $this->__get('id');
   }

   /**
    * Sets and/or retrieve the tagname of the element. ex: input, select, span, etc.
    *
    * @param string $tagname  The tagname.
    * @return string The tagname.
    */
   protected
   function tagname ( $tagname=null )
   {
      if ($tagname !== null) $this->tagname = $tagname;
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

   /**
    * Tell if the tagname match.
    *
    * @param string $tagname  The tagname.
    * @return boolean   True if it match, false otherwise.
    */
   function is ( $tagname )
   {
      return strtolower($this->tagname) === $tagname ||
            (strtolower($this->tagname) === 'input' && static::isInputType($tagname) && $this->getAttribute('type') === $tagname);
   }

   /**
    * Teel it this element is a non container element.
    *
    * @return boolean   True if it's a non container element, false otherwise.
    */
   function isNonContainer ()
   {
      return strpos($this->htmltag, ' />') !== false;
   }

   /**
    * Retrieve the children of this element.
    *
    * @return Element|Text A child.
    */
   function & elements ()
   {
      foreach ( $this->children as &$child )
      {
         yield $child;
         if ( Children::hasChildren($child) ) foreach ( $child->elements() as $subchild ) yield $subchild;
      }

   }

   /**
    * Retrieve the open tagname of this element.
    *
    * @return string The opening tag.
    */
   function open ()
   {
      return sprintf($this->split_htmltag()[0], $this->tagname, parent::__toString(), '');
   }

   /**
    * Retrieve the close tag of this element.
    *
    * @return string The closing tag.
    */
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