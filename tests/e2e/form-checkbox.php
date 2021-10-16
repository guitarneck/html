<?php
require dirname(__DIR__).'/../vendor/autoload.php';

$form = HTML\Factory::Form('myform',['enctype'=>HTML\Form::ENCTYPE_DATA]);

$checked = array();
$form->add(
   HTML\Factory::Input('chk[]','checkbox',array(
      'value'  => 'one'
   ))->validator(function($chk, $parent){
      global $checked;
      if ( strpos($chk->value,'one') !== false ) $checked[] = 'one';
      $chk->value = 'one';
   })
);
$form->add(
   HTML\Factory::Input('chk[]','checkbox',array(
      'value'  => 'two'
   ))->validator(function($chk, $parent){
      global $checked;
      if ( strpos($chk->value,'two') !== false ) $checked[] = 'two';
      $chk->value = 'two';
   })
);
$form->add(
   HTML\Factory::Input('chk[]','checkbox',array(
      'value'  => 'three'
   ))->validator(function($chk, $parent){
      global $checked;
      if ( strpos($chk->value,'three') !== false ) $checked[] = 'three';
      $chk->value = 'three';
   })
);


$form->add(new HTML\Element('input',['type'=>'submit','name'=>'ok','value'=>'ok']));

if ( $form->isSubmitted() )
{
   //var_dump($checked);
   //echo '<pre>',var_export($_REQUEST),'</pre>';
}

echo $form->open(),PHP_EOL;
echo $form('chk[]');
echo $form('ok');
echo PHP_EOL,$form->close(),PHP_EOL;
?>