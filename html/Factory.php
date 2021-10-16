<?php

namespace HTML;

/**
 * Factory class to to create elements.
 *
 * @class Factory
 * @file Factory.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class Factory
{
   /**
    * Create a Form object.
    *
    * @static
    * @param string $name        The name of the form.
    * @param array $attributes   Additional attributes of the form.
    * @return Form   A Form object.
    */
   static
   function Form ( $name='', $attributes=array() )
   {
      $attributes['name'] = $name;
      return new Form($attributes);
   }

   /**
    * Create a Text object.
    *
    * @static
    * @param string $text  The text.
    * @return Text         A text object.
    */
   static
   function Text ( $text='' )
   {
      return new Text($text);
   }

   /**
    * Create an input Element.
    *
    * @static
    * @param string $name        The name of the input.
    * @param string $type        The type of the input [default: submit].
    * @param array $attributes   Additional attributes of the input.
    * @return Element            An input Element object.
    */
   static
   function Input ( $name='', $type='submit', $attributes=array() )
   {
      if ( !Element::isInputType($type) ) user_error('input type is unknown' ,E_USER_WARNING);

      $attributes['name'] = $name;
      $attributes['type'] = $type;
      return new Element('input', $attributes);
   }

   /**
    * Create an button Element.
    *
    * @static
    * @param string $name        The name of the button.
    * @param string $type        The type of the button [default: button].
    * @param array $attributes   Additional attributes of the input.
    * @return Element            A button Element object.
    */
   static
   function Button ( $name='', $type='button', $attributes=array() )
   {
      $attributes['name'] = $name;
      $attributes['type'] = $type;
      return new Element('button', $attributes);
   }

   /**
    * Create an textarea Element.
    *
    * @static
    * @param string $name        The name of the textarea.
    * @param array $attributes   Additional attributes of the textarea.
    * @param string|null $text   Optional text of the textarea.
    * @return Element            A textarea Element object.
    */
   static
   function Textarea ( $name='', $attributes=array(), $text=null )
   {
      $attributes['name'] = $name;
      if ( $text !== null )
         return (new Element('textarea', $attributes))->add(static::Text($text));
      else
         return new Element('textarea', $attributes);
   }

   /**
    * Create an select Element.
    *
    * @static
    * @param string $name        The name of the select.
    * @param array $attributes   Additional attributes of the select.
    * @return Element            A select Element object.
    */
   static
   function Select ( $name='', $attributes=array() )
   {
      $attributes['name'] = $name;
      return new Element('select', $attributes);
   }

   /**
    * Create an option Element.
    *
    * @static
    * @param string $text        The text of the option.
    * @param string $value       The value of the option.
    * @param array $attributes   Additional attributes of the option.
    * @return Element            A option Element object.
    */
   static
   function Option ( $text='', $value='', $attributes=array() )
   {
      $attributes['value'] = $value;
      return (new Element('option', $attributes))->add(static::Text($text));
   }

   /**
    * Create an optgroup Element.
    *
    * @static
    * @param string $label       The label of the optgroup
    * @param array $attributes   Additional attributes of the optgroup.
    * @return Element            A optgroup Element object.
    */
   static
   function Group ( $label='', $attributes=array() )
   {
      $attributes['label'] = $label;
      return new Element('optgroup', $attributes);
   }

   /**
    * Create a label Element.
    *
    * @static
    * @param Element|string $for    An Element object or an id for the label.
    * @param mixed $content         The content of the label.
    * @param array $attributes      Additional attributes of the label.
    * @return Element               A label Element object.
    */
   static
   function Label ( $for, $content=null, $attributes=array() )
   {
      $attributes['for'] = is_a($for, Element::class) ? $for->id() : $for;

      if ( $content !== null )
         if ( is_string($content) )
            return (new Element('label', $attributes))->add(static::Text($content));
         else
            return (new Element('label', $attributes))->add($content);
      else
         return new Element('label', $attributes);
   }

   /**
    * Create a datalist Element.
    *
    * @static
    * @param Element $input      The input element for the datalist.
    * @param array $attributes   Additional attributes of the datalist.
    * @return Element            A datalist Element object.
    */
   static
   function Datalist ( & $input, $attributes=array() )
   {
      $datalist = new Element('datalist', $attributes);
      $input->setAttribute('list', $datalist->id());
      return $datalist;
   }

   /**
    * Create an output Element.
    *
    * @static
    * @param string $name        The name of the output.
    * @param array $attributes   Additional attributes of the output.
    * @return Element            A output Element object.
    */
   static
   function Output ( $name, $attributes=array() )
   {
      $attributes['name'] = $name;
      return new Element('output', $attributes);
   }

   /**
    * Create a meter Element.
    *
    * @static
    * @param string $name        The name of the meter.
    * @param array $attributes   Additional attributes of the meter.
    * @return Element            A meter Element object.
    */
   static
   function Meter ( $name, $attributes=array() )
   {
      $attributes['name'] = $name;
      return new Element('meter', $attributes);
   }

   /**
    * Create a progress Element.
    *
    * @static
    * @param string $name        The name of the progress.
    * @param array $attributes   Additional attributes of the progress.
    * @return Element            A progress Element object.
    */
   static
   function Progress ( $name, $attributes=array() )
   {
      $attributes['name'] = $name;
      return new Element('progress', $attributes);
   }
}