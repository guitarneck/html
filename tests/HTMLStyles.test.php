<?php
require 'bootstrap.php';

$styl = new HTML\Styles("color:rgba(0,0,0,1);   background:red;float:right; border:1px solid black");
$styl->display = 'block';
$styl->{'margin-top'} = '1px';
$styl->setProperty('margin-left','2em');
$styl->paddingTop = '2rem';

test('HTMLStyles methods exists',function($t) use($styl){
   $t->ok(method_exists($styl,'hasProperty'));
   $t->ok(method_exists($styl,'getProperty'));
   $t->ok(method_exists($styl,'setProperty'));
   $t->ok(method_exists($styl,'setProperties'));
   $t->end();
});

test('HTMLStyles accessors',function($t) use($styl){
   $t->ok($styl->hasProperty('display'),'It should returns property exists');
   $t->equal($styl->getProperty('display'),'block','It should get the property');
   $t->end();
});

test('HTMLStyles accessors and deletion',function($t) use($styl){
   $t->ok($styl->hasProperty('margin-top'),'It should returns property exists');
   unset($styl->{'margin-top'});
   $t->not_ok($styl->hasProperty('margin-top'),'It should returns property not existing anymore');
   $t->end();
});

test('HTMLStyles accessors and modification',function($t) use($styl){
   $t->equal($styl->getProperty('margin-left'),'2em','It should get the property');
   $styl->setProperty('margin-left','5em');
   $t->equal($styl->getProperty('margin-left'),'5em','It should get the changed property');
   $t->end();
});

test('echoing',function($t) use($styl){
   $expected = 'color:rgba(0,0,0,1);background:red;float:right;border:1px solid black;display:block;margin-left:5em;padding-top:2rem';
   $actual = $styl->__toString();
   $t->equal($actual,$expected);
   $t->end();
});