<?php

require 'bootstrap.php';
require dirname(__DIR__).'/vendor/guitarneck/taphp-color/taphp-color.php';

require_once 'WWW.class.php';

$www = new WWW();

test('get a form with select box',function($t) use($www) {
   $html = $www->get('form-select.php',array('opts=3'));
   $t->ok( strpos($html,'<form ') !== false,'Element form exists');
   $t->ok( strpos($html,'<select ') !== false,'Element select exists');
   $t->ok( strpos($html,'<option ') !== false,'Element option exists');
   $t->ok( strpos($html,'<input type="submit" ') !== false,'Element submit exists');
   $t->ok( strpos($html,' selected>option 3</option>') !== false,'option 3 should be selected');
   $t->end();
});

test('closing $www',function($t) use($www) {
   $www->close();
   $t->pass();
   $t->end();
});