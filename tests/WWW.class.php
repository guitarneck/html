<?php

class WWW
{
   protected   $handle;

   function __construct ()
   {
      $nul = PHP_OS !== 'WINNT' ? '/dev/null &' : 'nul';
      $bck = PHP_OS !== 'WINNT' ? '' : 'start /B ';
      $this->handle = popen("${bck}php -S localhost:8765 -t tests/e2e/ 2>$nul", 'r');
   }

   function __destruct()
   {
      $this->close();
   }

   function get ( $page, array $parameters=array() )
   {
      $parms = count($parameters) > 0 ? '?' . implode('&',$parameters) : '';
      ob_start();
      echo file_get_contents("http://localhost:8765/$page$parms");
      return ob_get_clean();
   }

   function close ()
   {
      if ($this->handle) pclose($this->handle);
      $this->handle = false;
   }
}