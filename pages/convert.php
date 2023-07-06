<?php

// Program to illustrate base64_decode()
// function


echo $b64Doc = chunk_split(base64_encode(file_get_contents('1704231250.pdf')));


 
 $decode=base64_decode($b64Doc);

$pdf= fopen('tesetesport.pdf','w');
fwrite($pdf,$decode);

?>