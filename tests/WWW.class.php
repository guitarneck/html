<?php

class WWW
{
   protected   $handle;

   function __construct ()
   {
      $nul = PHP_OS !== 'WINNT' ? '/dev/null &' : 'nul';
      $bck = PHP_OS !== 'WINNT' ? '' : 'start /wait /B ';
      $this->handle = proc_open("${bck}php -S localhost:8765 -t tests/e2e/ 2>$nul", array(), $pipe);
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

   private
   function kill ( $pid )
   {
      // tasklist
      ob_start();
      if ( PHP_OS === 'WINNT' )
         system("taskkill /PID $pid /T /F");
      else
         system("kill -9 $pid");
      ob_end_clean();
   }

   function close ()
   {
      if ($this->handle)
      {
         $status = proc_get_status($this->handle);
         $this->kill($status['pid']);
         proc_terminate($this->handle);
         proc_close($this->handle);
      }
      $this->handle = false;
   }
}