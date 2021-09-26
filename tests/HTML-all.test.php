<?php
require 'bootstrap.php';
require dirname(__DIR__).'/vendor/guitarneck/taphp-color/taphp-color.php';

function TDDTrapOutput ( $filename )
{
   $curdir = __DIR__;
   $nul = PHP_OS !== 'WINNT' ? '/dev/null' : 'nul';
   ob_start();
   system("php -f $curdir/HTML$filename.test.php 2>$nul");
   return ob_get_clean();   
}

// echo 'this should takes a couple of seconds...',TAP_EOL;

test('testing ...', function ($t) {
   
   $all = [
      'Attributes'      => 15,
      'Classes'         => 9,
      'Styles'          => 11,
   ];

   foreach ( $all as $tdd => $pass )
   {
      $output = TDDTrapOutput($tdd);
   
      $t->comment("--- testing tdd `$tdd`");
      $t->ok( strpos($output,'TAP version 13') !== false, 'TAPHP has runned' );
      $t->ok( strpos($output,"# pass  $pass") !== false, "`$tdd` should succeed" );
   }

   $t->end();
});