

   

<?php 

include("function.php");

include("patient_report_pdf.php");



$patient_id=$_GET['p_id'];
$datee=$_GET['date'];

     
 
$cur_date = date('d').date('m').date('y');
  $invoice = $cur_date;
  //echo $invoice.'</br>';
  $customer_id = rand(0000 , 9999);
  $report = $invoice.$customer_id;

 
 GeneratePDFLetter1($patient_id,$datee,$report);
  serial2($patient_id,$datee,$report);
  
?>
<br>
<br>
<a href="insurence_patient_details.php" ><button class="btn btn-primary" style="background-color:green;color:white;border:green solid 1px" ><h2>HOME</h2></button></a>

 