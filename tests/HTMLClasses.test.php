<?php
require 'bootstrap.php';

$clas = new HTML\Classes("btn  btn-primary p-1   m-0");
$clas->left = true;
$clas->right = !$clas->left;
$clas->textCenter = 1;
$clas->backgroundTransparent = 0;
$clas->color = function(&$k){$k = 'color-secondary'; return true; };

test('HTMLClasses methods exists',function($t) use($clas){
   $t->ok(method_exists($clas,'hasClass'));
   $t->ok(method_exists($clas,'getClass'));
   $t->ok(method_exists($clas,'setClass'));
   $t->ok(method_exists($clas,'setClasses'));
   $t->end();
});

test('HTMLClasses accessors',function($t) use($clas){
   $t->ok($clas->hasClass('left'),'It should returns class exists');
   $t->equal($clas->getClass('right'),false,'It should get the class content');
   $t->ok($clas->hasClass('textCenter'),'It should returns class exists');
   unset($clas->{'text-center'});
   $t->not($clas->hasClass('text-center'),'It should not returns class removed');
   $t->end();
});

test('HTMLClasses rendering',function($t) use($clas){
   $t->equal($clas->__toString(),'btn btn-primary p-1 m-0 left color-secondary','rendering should works');
   $t->end();
});

$os = shell_exec('echo ✓'); echo PHP_EOL,$os,PHP_EOL;
echo mb_chr(0x20ac,'utf-8') === '€',PHP_EOL;
echo 0x8364,PHP_EOL;