<?php
require dirname(__DIR__).'/../vendor/autoload.php';

$form = HTML\Factory::Form('myform',['enctype'=>HTML\Form::ENCTYPE_DATA]);

$select = HTML\Factory::Select('opts[]',[
   'multiple'  => null,
   'class'     => 'btn btn-primary',
   'style'     => new HTML\Styles('background-color:white;color:blue;border:.1em solid black;border-radius:.5em')
])->validator(function($form, $parent){
   echo '<b>',$form->value,'</b><br />',PHP_EOL;
});

$select->add([
   HTML\Factory::Option('option 1','1'),
   HTML\Factory::Option('option 2','2',['selected'=>null]),
   HTML\Factory::Option('option 3','3'),
   HTML\Factory::Option('option 4','4'),
]);

$select->add(
   (HTML\Factory::Group('Label 1'))->add([
      HTML\Factory::Option('option 5','5'),
      HTML\Factory::Option('option 6','6')
   ])
);

$form->add($select);

$form->add(new HTML\Element('input',['type'=>'submit','name'=>'ok','value'=>'ok']));

if ( $form->isSubmitted() )
{
   echo '<pre>',var_export($_REQUEST),'</pre>';
}

echo $form->open(),PHP_EOL;
echo $form('opts[]');
echo $form('ok');
echo PHP_EOL,$form->close(),PHP_EOL;
?>