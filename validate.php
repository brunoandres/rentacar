<?php

$date="4444-12-12";
if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)){
  echo "is ok!";
}else{
  echo "Error";
}



?>
