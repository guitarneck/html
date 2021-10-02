<?php
require 'bootstrap.php';

test('BooleanAttributes with matching attributes',function($t){
   $attributes = array(
      'allowfullscreen',
      'allowpaymentrequest',
      'async',
      'autofocus',
      'autoplay',
      'checked',
      'controls',
      'default',
      'disabled',
      'formnovalidate',
      'hidden',
      'ismap',
      'itemscope',
      'loop',
      'multiple',
      'muted',
      'nomodule',
      'novalidate',
      'open',
      'playsinline',
      'readonly',
      'required',
      'reversed',
      'selected',
      'truespeed'
   );

   $t->plan(count($attributes));

   foreach ( $attributes as $attribute )
      $t->ok(HTML\BooleanAttributes::match($attribute));
});

test('BooleanAttributes with unmatching attributes',function($t){
   $t->no(HTML\BooleanAttributes::match('id'));
   $t->no(HTML\BooleanAttributes::match('name'));
   $t->end();
});