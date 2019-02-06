<?php

  define('HOST','localhost');

  define('USER','root');

  define('PASS','password');

  define('DB', 'intsec');

  $conn = mysqli_connect(HOST,USER,PASS,DB);

   if (!$conn){
      die("Error in connection" . mysqli_connect_error()) ;
  }
?>