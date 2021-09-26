<?php
require 'bootstrap.php';

$attr = new HTML\Attributes("machin='bidule'  truc='aussi'");
$attr->action = "/www/faire/un/truc";

test('HTMLAttributes methods exists',function($t) use($attr){
   $t->ok(method_exists($attr,'hasAttribute'));
   $t->ok(method_exists($attr,'getAttribute'));
   $t->ok(method_exists($attr,'setAttribute'));
   $t->ok(method_exists($attr,'setAttributes'));
   $t->end();
});

test('HTMLAttributes accessors',function($t) use($attr){
   $t->ok($attr->hasAttribute('truc'),'It should returns attribute exists');
   $t->equal($attr->getAttribute('truc'),'aussi','It should get the attributes');
   $t->end();
});

test('HTMLAttributes iterator',function($t) use($attr){
   $all = array(
      'machin' => 'bidule',
      'truc'   => 'aussi',
      'action' => '/www/faire/un/truc'
   );
   foreach ( $attr->iterator() as $k => $v )
   {
      $t->ok(key_exists($k,$all));
      $t->equal($v,$all[$k]);
   }
   $t->end();
});

test('HTMLAttributes attributes',function($t) use($attr){
   $t->ok(property_exists($attr,'machin'), '`machin` attribute should exists');
   $t->not($attr->action ?? 'no','no', '`action` attribute should exists');
   $t->end();
});

test('HTMLAttributes rendering',function($t) use($attr){
   $t->equal($attr->__toString(),'machin="bidule" truc="aussi" action="/www/faire/un/truc"','rendering should works');
   $t->end();
});