<?php

namespace HTML;

class ChildrenList
{
   private $list = array();

   function add ( & $child )
   {
      $this->list[] = $child;
   }

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

trait Children
{
   private  $children = array();

   static
   function hasChildren ( $object )
   {
      return property_exists($object,'children') && 0 < $object->length();
   }

   function length ()
   {
      return count($this->children);
   }

   function & add ( $element )
   {
      if ( is_array($element) )
         $this->children = array_merge($this->children, $element);
      else
         $this->children[] = $element;
      return $this;
   }

   function remove ( $element )
   {
      if ( ! is_subclass_of($element,'HTML::Element') ) return;
      $this->children = array_filter($this->children, function($child) use ($element) {
         return $child->id() != $element->id();
      });
      return $this;
   }

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

   function & elementById ( $id )
   {
      $null = null; // Return by reference case
      foreach ( $this->children as $child )
      {
         if ( $child->{'id'} === $id ) return $child;
      }
      return $null;
   }

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