

   

<?php 

include("function.php");
include("PDFne.php");




 $patient_id=$_POST['patient_id'];

  $p_date=$_POST['p_date'];
   $serial=$_POST['serial'];
      $namee=$_POST['med'];
       $itemcode=$_POST['itemcode'];



$quanti=$_POST['numm'];
$nprice=$_POST['nummprice'];

$total_pay = array_map(function($hour, $rate) {
	return $hour * $rate;
}, $quanti, $nprice);
           


$total_pay;
 foreach($namee as $row=>$namee)
 {
    $p_id=$_POST['patient_id'][$row];
    $p_date=$_POST['p_date'][$row];
 
  $med=$_POST['med'][$row];
 $qunti=$_POST['numm'][$row];
 $price=$_POST['nummprice'][$row];
 $itemcode=$_POST['itemcode'][$row];
   $totall=$total_pay[$row];
    $serial;
insurence($serial,$p_id,$p_date,$itemcode,$med,$qunti,$price,$totall);
 }


     
 $patient_idd=$_POST['patient_idd'];
 $datee =$_POST['p_datee'];
 $serial_no=$serial; 
  $report=$patient_idd.'-'.$datee;
 GeneratePDFLetter($patient_idd,$datee,$serial_no);
 //GeneratePDFLetter1($patient_idd,$datee,$serial_no);

serial1($patient_idd,$datee,$serial_no);
 //$b64Doc1 = chunk_split(base64_encode(file_get_contents($serial_no.'.pdf.')));
?><br><br>
<a href="demo3.php?p_id=<?php echo $patient_idd; ?>&date=<?php echo $datee; ?>" ><button class="btn btn-primary" style="background-color:green;color:white;border:green solid 1px" ><h2>Next </h2></button></a>
<?php
