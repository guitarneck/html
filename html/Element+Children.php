<?php

namespace HTML;

/**
 * Class to manage a children list of Elements.
 *
 * @class ChildrenList
 * @file Element+Children.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class ChildrenList
{
   private $list = array();

   /**
    * Add an element to the children list.
    *
    * @param Element|Text $child    The child to add.
    */
   function add ( & $child )
   {
      $this->list[] = $child;
   }

   /**
    * Retrieve a child by its id. null when not found.
    *
    * @param string  The id.
    * @return null|Element|Text  The child.
    */
   function & byId ( $id )
   {
      $null = null; // Return by reference case
      foreach ( $this->list as &$child )
      {
         if ( $child->{'id'} === $id ) return $child;
      }
      return $null;
   }

   function __toString ()
   {
      $string = '';
      foreach ( $this->list as $child ) $string .= $child->__toString();
      return $string;
   }
}

/**
 * Trait to manage the children of an Element.
 *
 * @class Children
 * @file Element+Children.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
trait Children
{
   private  $children = array();

   /**
    * Tell if an element has children.
    *
    * @static
    * @param Element $object  An element.
    * @return boolean   True when element has children, false otherwise.
    */
   static
   function hasChildren ( $object )
   {
      return property_exists($object,'children') && 0 < $object->length();
   }

   /**
    * Retive the number of children of an element.
    *
    * @return int The numbre of children.
    */
   function length ()
   {
      return count($this->children);
   }

   /**
    * Add an Element or a Text to the children of an Element.
    *
    * @param Element|Text|Array $element  The child to add.
    * @return Element This instance.
    */
   function & add ( $element )
   {
      if ( is_array($element) )
         $this->children = array_merge($this->children, $element);
      else
         $this->children[] = $element;
      return $this;
   }

   /**
    * Remove an Element or a Text from the children of an Element.
    *
    * @param Element|Text $element  The child to remove.
    * @return Element This instance.
    */
    function remove ( $element )
   {
      if ( ! is_subclass_of($element,'HTML::Element') ) return;
      $this->children = array_filter($this->children, function($child) use ($element) {
         return $child->id() != $element->id();
      });
      return $this;
   }

   /**
    * Retrieve a reference to the children list of an element.
    *
    * @param string $name  The name of the child.
    * @return ChildrenList A children list.
    */
   // $child = & $parent->elementsByName('foo');
   function & elementsByName ( $name )
   {
      $list = new ChildrenList();
      foreach ( $this->children as &$child )
      {
         if ( isset($child->{'name'}) && $child->{'name'} === $name ) $list->add($child);
      }
      return $list;
   }

   /**
    * Retrieve a child by its id. null if not found.
    *
    * @param string $id The id.
    * @return Element|null The child or null.
    */
   function & elementById ( $id )
   {
      $null = null; // Return by reference case
      foreach ( $this->children as $child )
      {
         if ( $child->{'id'} === $id ) return $child;
      }
      return $null;
   }

   /**
    * Callable.
    *
    * @param string $name  The name of the element.
    * @return Element|Text The element.
    * @see Children::elementsByName()
    */
   function & __invoke ( $name )
   {
      return $this->elementsByName( $name );
   }

   function __toString ()
   {
      $children = '';
      foreach ($this->children as $child) $children .= $child->__toString();
      return $children;
   }
}